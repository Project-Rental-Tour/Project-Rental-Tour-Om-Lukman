<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Gallery;

class GalleriesController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'You need to login first']);
        }

        $galleries = Gallery::latest()->get();
        return view('admin.manageGallery', compact('galleries'));
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'Unauthorized access']);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'gallery_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $imagePath = $request->file('gallery_photo')->store('public/galleries');

            Gallery::create([
                'title' => $validated['title'],
                'gallery_photo' => str_replace('public/', 'storage/', $imagePath),
            ]);

            return redirect()->route('manage-gallery.index')
                ->with('success', 'Gallery item added successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to upload: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, $gallery_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'Unauthorized access']);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'gallery_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $gallery = Gallery::findOrFail($gallery_id);
            $updateData = ['title' => $validated['title']];

            if ($request->hasFile('gallery_photo')) {
                // Delete old image
                Storage::delete(str_replace('storage/', 'public/', $gallery->gallery_photo));

                // Store new image
                $imagePath = $request->file('gallery_photo')->store('public/galleries');
                $updateData['gallery_photo'] = str_replace('public/', 'storage/', $imagePath);
            }

            $gallery->update($updateData);

            return redirect()->route('manage-gallery.index')
                ->with('success', 'Gallery updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Update failed: ' . $e->getMessage()]);
        }
    }

    public function destroy($gallery_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'Unauthorized access']);
        }

        try {
            $gallery = Gallery::findOrFail($gallery_id);
            Storage::delete(str_replace('storage/', 'public/', $gallery->gallery_photo));
            $gallery->delete();

            return redirect()->route('manage-gallery.index')
                ->with('success', 'Gallery deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Delete failed: ' . $e->getMessage()]);
        }
    }

    public function bulkDestroy(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:galleries,gallery_id',
        ]);

        try {
            $galleries = Gallery::whereIn('gallery_id', $validated['ids'])->get();

            foreach ($galleries as $gallery) {
                Storage::delete(str_replace('storage/', 'public/', $gallery->gallery_photo));
                $gallery->delete();
            }

            return response()->json(['success' => 'Selected galleries deleted']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Bulk delete failed'], 500);
        }
    }
}
