<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Testimonial;

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

        $query = Testimonial::query(); // Ganti dari latest() agar bisa di-sort

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


        Testimonial::create([
            'name'       => $validatedData['name'],
            'role'       => $validatedData['role'],
            'location'   => $validatedData['location'],
            'content'    => $validatedData['content'],
            'rating'     => $validatedData['rating'],
            'user_id'    => Auth::id(),
        ]);

        return redirect()->route('manage-testimonials.index')->with('success', 'Testimonial added successfully.');
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

        // Update menggunakan assignment (seperti BlogPost)
        $testimonial->name       = $validatedData['name'];
        $testimonial->role       = $validatedData['role'];
        $testimonial->location   = $validatedData['location'];
        $testimonial->content    = $validatedData['content'];
        $testimonial->rating     = $validatedData['rating'];
        $testimonial->save();

        return redirect()->route('manage-testimonials.index')->with('success', 'Testimonial updated successfully.');
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
        $testimonial->delete();

        return redirect()->route('manage-testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }

    /**
     * Remove multiple resources.
     */
    public function bulkDestroy(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'toast' => ['type' => 'error', 'message' => 'You do not have permission to view this page.']
            ], 401);
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:testimonials,testimonial_id',
        ]);

        Testimonial::whereIn('testimonial_id', $request->ids)->delete();

        return redirect()->route('manage-testimonials.index')->with('success', 'Selected testimonials deleted successfully.');
    }
}
