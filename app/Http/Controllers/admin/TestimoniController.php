<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Testimonial;
use App\Models\LogActivity;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $query = Testimonial::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->orWhere('rating', 'like', "%{$search}%");
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name-asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name', 'desc');
                break;
            case 'rating-high':
                $query->orderBy('rating', 'desc');
                break;
            case 'rating-low':
                $query->orderBy('rating', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $testimonials = $query->paginate(10)->appends($request->except('page'));
        return view('admin.manageTestimonial', compact('testimonials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $validatedData = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'role'      => 'required|string|max:255',
            'location'  => 'required|string|max:255',
            'content'   => 'required|string',
            'rating'    => 'required|integer|between:1,5',
        ])->validate();

        $testimonial = Testimonial::create([
            'name'       => $validatedData['name'],
            'role'       => $validatedData['role'],
            'location'   => $validatedData['location'],
            'content'    => $validatedData['content'],
            'rating'     => $validatedData['rating'],
            'user_id'    => Auth::id(),
        ]);

        LogActivity::create([
            'username' => $currentUser->username,
            'action' => 'Added testimonial: "' . $testimonial->content . '" by ' . $testimonial->name,
        ]);

        return redirect()->route('manage-testimonials.index')->with('toast', [
            'type' => 'success',
            'message' => 'Testimonial added successfully.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $testimonial_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $testimonial = Testimonial::findOrFail($testimonial_id);

        $validatedData = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'role'      => 'required|string|max:255',
            'location'  => 'required|string|max:255',
            'content'   => 'required|string',
            'rating'    => 'required|integer|between:1,5',
        ])->validate();

        // Simpan nama lama untuk log
        $oldName = $testimonial->name;
        $oldContent = Str::limit($testimonial->content, 50);

        // Update data
        $testimonial->name       = $validatedData['name'];
        $testimonial->role       = $validatedData['role'];
        $testimonial->location   = $validatedData['location'];
        $testimonial->content    = $validatedData['content'];
        $testimonial->rating     = $validatedData['rating'];
        $testimonial->save();

        LogActivity::create([
            'username' => $currentUser->username,
            'action' => "Updated testimonial: '{$oldName}' → '{$testimonial->name}' (Content: \"{$oldContent}...\")"
        ]);

        return redirect()->route('manage-testimonials.index')->with('toast', [
            'type' => 'success',
            'message' => 'Testimonial updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($testimonial_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $testimonial = Testimonial::findOrFail($testimonial_id);
        $deletedName = $testimonial->name;
        $deletedContent = Str::limit($testimonial->content, 30);

        $testimonial->delete();

        LogActivity::create([
            'username' => $currentUser->username,
            'action' => "Deleted testimonial: '{$deletedName}' (Content: \"{$deletedContent}...\")"
        ]);

        return redirect()->route('manage-testimonials.index')->with('toast', [
            'type' => 'success',
            'message' => 'Testimonial deleted successfully.'
        ]);
    }

    /**
     * Remove multiple resources.
     */
    public function bulkDestroy(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', [
                'type' => 'error',
                'message' => 'You do not have permission to view this page.'
            ]);
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:testimonials,testimonial_id',
        ]);

        try {
            $testimonials = Testimonial::whereIn('testimonial_id', $request->ids)->get();
            $count = $testimonials->count();

            if ($count === 0) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'No testimonials selected.'
                ]);
            }

            $names = $testimonials->pluck('name')->join(', ');

            Testimonial::whereIn('testimonial_id', $request->ids)->delete();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Bulk deleted {$count} testimonial(s): {$names}"
            ]);

            if (!$request->expectsJson()) {
                return redirect()->route('manage-testimonials.index')->with('toast', [
                    'type' => 'success',
                    'message' => "Successfully deleted {$count} testimonial(s)."
                ]);
            }

            return response()->json([
                'success' => true,
                'toast' => [
                    'type' => 'success',
                    'message' => "Successfully deleted {$count} testimonial(s)."
                ]
            ]);
        } catch (\Exception $e) {
            if (!$request->expectsJson()) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'Bulk delete failed: ' . $e->getMessage()
                ]);
            }

            return response()->json([
                'success' => false,
                'toast' => [
                    'type' => 'error',
                    'message' => 'Bulk delete failed: ' . $e->getMessage()
                ]
            ], 500);
        }
    }
}
