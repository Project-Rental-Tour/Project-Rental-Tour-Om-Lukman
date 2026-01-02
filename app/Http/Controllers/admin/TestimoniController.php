<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Models\Testimonial;
use App\Models\LogActivity;
use App\Models\Profile;

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

        $profiles = Profile::find(1) ?? Profile::first();

        $query = Testimonial::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->orWhere('rating', 'like', "%{$search}%")
                ->orWhere('image', 'like', "%{$search}%");
        }

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

        $notifications = LogActivity::where('action', 'like', '%Submitted custom trip request%')
            ->orWhere('action', 'like', '%Submitted regular booking%')
            ->latest()
            ->take(10)
            ->get();

        LogActivity::create([
            'username' => $currentUser->username,
            'action' => 'Viewed Testimoni list (filtered: ' . ($request->filled('search') ? 'yes' : 'no') . ')'
        ]);

        $testimonials = $query->paginate(10)->appends($request->except('page'));
        return view('Admin.manageTestimonial', compact('testimonials', 'notifications', 'profiles'));
    }

    /**
     * Helper function to compress and store image
     */
    private function processImage($file)
    {
        // Create new image manager instance with GD driver
        $manager = new ImageManager(new Driver());

        // Read image from file
        $image = $manager->read($file);

        // Resize image if it's too large (Testimonials usually don't need > 800px width)
        if ($image->width() > 800) {
            $image->scale(width: 800);
        }

        // Encode image to JPEG with 75% quality
        $encoded = $image->toJpeg(75);

        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.jpg';
        $path = 'testimonial-images/' . $filename;

        // Store image using Laravel Storage on 'public' disk
        Storage::disk('public')->put($path, (string) $encoded);

        // Return the path relative to the disk root
        return $path;
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
            'name'      => 'nullable|string|max:255',
            'role'      => 'nullable|string|max:255',
            'location'  => 'nullable|string|max:255',
            'content'   => 'nullable|string',
            'rating'    => 'nullable|integer|between:1,5',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // Increased limit to 5MB
        ])->validate();

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                // Use helper to compress and store
                $imagePath = $this->processImage($request->file('image'));
            }

            $testimonial = Testimonial::create([
                'name'       => $validatedData['name'] ?? null,
                'role'       => $validatedData['role'] ?? null,
                'location'   => $validatedData['location'] ?? null,
                'content'    => $validatedData['content'] ?? null,
                'rating'     => $validatedData['rating'] ?? 5,
                'image'      => $imagePath,
                'user_id'    => Auth::id(),
            ]);

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Added testimonial: "' . ($testimonial->content ? Str::limit($testimonial->content, 30) : 'No content') . '" by ' . ($testimonial->name ?? 'Anonim'),
            ]);

            return redirect()->route('manage-testimonials.index')->with('toast', [
                'type' => 'success',
                'message' => 'Testimonial added successfully.'
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->with('toast', [
                'type' => 'error',
                'message' => 'Failed to add testimonial: ' . $e->getMessage()
            ]);
        }
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
            'name'      => 'nullable|string|max:255',
            'role'      => 'nullable|string|max:255',
            'location'  => 'nullable|string|max:255',
            'content'   => 'nullable|string',
            'rating'    => 'nullable|integer|between:1,5',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // Increased limit to 5MB
            'remove_image' => 'nullable|boolean',
        ])->validate();

        $oldName = $testimonial->name;
        $oldContent = Str::limit($testimonial->content ?? 'No content', 50);
        $imagePath = $testimonial->image;

        try {
            // Handle Image Removal
            if ($request->has('remove_image') && $request->remove_image && $testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
                $imagePath = null;
            }

            // Handle New Image Upload
            if ($request->hasFile('image')) {
                if ($testimonial->image) {
                    Storage::disk('public')->delete($testimonial->image);
                }
                // Use helper to compress and store
                $imagePath = $this->processImage($request->file('image'));
            }

            $testimonial->name       = $validatedData['name'] ?? null;
            $testimonial->role       = $validatedData['role'] ?? null;
            $testimonial->location   = $validatedData['location'] ?? null;
            $testimonial->content    = $validatedData['content'] ?? null;
            $testimonial->rating     = $validatedData['rating'] ?? 5;
            $testimonial->image      = $imagePath;
            $testimonial->save();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Updated testimonial: '{$oldName}' → '{$testimonial->name}' (Content: \"{$oldContent}...\")"
            ]);

            return redirect()->route('manage-testimonials.index')->with('toast', [
                'type' => 'success',
                'message' => 'Testimonial updated successfully.'
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->with('toast', [
                'type' => 'error',
                'message' => 'Failed to update testimonial: ' . $e->getMessage()
            ]);
        }
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

        try {
            $testimonial = Testimonial::findOrFail($testimonial_id);
            $deletedName = $testimonial->name;
            $deletedContent = Str::limit($testimonial->content ?? 'No content', 30);

            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $testimonial->delete();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Deleted testimonial: '{$deletedName}' (Content: \"{$deletedContent}...\")"
            ]);

            return redirect()->route('manage-testimonials.index')->with('toast', [
                'type' => 'success',
                'message' => 'Testimonial deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Failed to delete: ' . $e->getMessage()
            ]);
        }
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

            foreach ($testimonials as $testimonial) {
                if ($testimonial->image) {
                    Storage::disk('public')->delete($testimonial->image);
                }
            }
            
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