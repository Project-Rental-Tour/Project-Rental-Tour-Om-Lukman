<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Blogs;
use App\Models\LogActivity;
use App\Models\Profile;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $query = Blogs::query();
        $profiles = Profile::find(1) ?? Profile::first();

        // 1. Search Logic
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        }

        // 2. Sort Logic
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title-asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title-desc':
                $query->orderBy('title', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // 3. Notifications (Log Activity)
        $notifications = LogActivity::where('action', 'like', '%Submitted%')
            ->orWhere('action', 'like', '%Added blog%')
            ->latest()
            ->take(10)
            ->get();

        LogActivity::create([
            'username' => $currentUser->username,
            'action' => 'Viewed Blog list (filtered: ' . ($request->filled('search') ? 'yes' : 'no') . ')'
        ]);

        // 5. Pagination
        $blogs = $query->paginate(10)->appends($request->except('page'));

        return view('Admin.manageBlog', compact('blogs', 'notifications', 'profiles'));
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission.']);
        }

        // Validasi (Tanpa Slug)
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'category'   => 'required|string|max:100',
            'time_read'  => 'required|integer|min:1',
            'content'    => 'required|string',
            // Pastikan input name di form adalah 'image_path' atau sesuaikan di sini
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        try {
            // Handle Image Upload
            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                // Simpan ke storage/app/public/blogs
                $path = $file->store('public/blogs');
                // Ubah path agar bisa diakses via asset() -> storage/blogs/filename.jpg
                $validated['image_path'] = str_replace('public/', 'storage/', $path);
            }

            $blog = Blogs::create($validated);

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Added blog post: "' . $blog->title . '" (Category: ' . $blog->category . ')',
            ]);

            return redirect()->route('manage-blog.index')
                ->with('toast', ['type' => 'success', 'message' => 'Blog post created successfully.']);

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to create blog: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $blog_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission.']);
        }

        // Cari blog berdasarkan blog_id
        $blog = Blogs::findOrFail($blog_id);

        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'category'   => 'required|string|max:100',
            'time_read'  => 'required|integer|min:1',
            'content'    => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Handle Image Update
            if ($request->hasFile('image_path')) {
                // Hapus gambar lama jika ada
                if ($blog->image_path && Storage::exists(str_replace('storage/', 'public/', $blog->image_path))) {
                    Storage::delete(str_replace('storage/', 'public/', $blog->image_path));
                }
                
                $path = $request->file('image_path')->store('public/blogs');
                $validated['image_path'] = str_replace('public/', 'storage/', $path);
            }

            $oldTitle = $blog->title;
            $blog->update($validated);

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Updated blog: '{$oldTitle}' → '{$blog->title}'",
            ]);

            return redirect()->route('manage-blog.index')
                ->with('toast', ['type' => 'success', 'message' => 'Blog updated successfully.']);

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Update failed: ' . $e->getMessage()]);
        }
    }

    public function destroy($blog_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission.']);
        }

        try {
            $blog = Blogs::findOrFail($blog_id);
            $deletedTitle = $blog->title;

            // Delete image
            if ($blog->image_path) {
                // Konversi path storage/ ke public/ untuk Storage facade
                $storagePath = str_replace('storage/', 'public/', $blog->image_path);
                if(Storage::exists($storagePath)) {
                    Storage::delete($storagePath);
                }
            }

            $blog->delete();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Deleted blog: "' . $deletedTitle . '" (ID: ' . $blog_id . ')',
            ]);

            return redirect()->route('manage-blog.index')
                ->with('toast', ['type' => 'success', 'message' => 'Blog deleted successfully.']);

        } catch (\Exception $e) {
            return back()->with('toast', ['type' => 'error', 'message' => 'Delete failed: ' . $e->getMessage()]);
        }
    }

    public function bulkDestroy(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission.']);
        }

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:blogs,blog_id',
        ]);

        try {
            $blogs = Blogs::whereIn('blog_id', $validated['ids'])->get();

            if ($blogs->isEmpty()) {
                return redirect()->back()->with('toast', ['type' => 'error', 'message' => 'No blogs selected.']);
            }

            $count = $blogs->count();
            $deletedTitles = $blogs->pluck('title');

            foreach ($blogs as $blog) {
                // Delete image
                if ($blog->image_path) {
                    $storagePath = str_replace('storage/', 'public/', $blog->image_path);
                    if(Storage::exists($storagePath)) {
                        Storage::delete($storagePath);
                    }
                }
                $blog->delete();
            }

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Bulk deleted {$count} blog(s): " . $deletedTitles->join(', '),
            ]);

            if (!$request->expectsJson()) {
                return redirect()->route('manage-blog.index')->with('toast', [
                    'type' => 'success', 
                    'message' => "{$count} blog(s) deleted successfully."
                ]);
            }

            return response()->json([
                'success' => true,
                'toast' => ['type' => 'success', 'message' => "{$count} blog(s) deleted successfully."]
            ]);

        } catch (\Exception $e) {
            if (!$request->expectsJson()) {
                return redirect()->back()->with('toast', ['type' => 'error', 'message' => 'Bulk delete failed: ' . $e->getMessage()]);
            }
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}