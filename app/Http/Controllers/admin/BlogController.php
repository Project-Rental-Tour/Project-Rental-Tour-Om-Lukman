<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Untuk Slug
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager; // Untuk Gambar
use Intervention\Image\Drivers\Gd\Driver; // Driver Gambar

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

        // 3. Notifications
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

    /**
     * Helper: Compress & Resize Image
     */
    private function processImage($file, $path = 'public/blogs', $quality = 75)
    {
        // 1. Init Image Manager (Driver GD)
        $manager = new ImageManager(new Driver());

        // 2. Baca File
        $image = $manager->read($file);

        // 3. Resize jika terlalu lebar (misal max 1200px untuk blog) agar ringan
        if ($image->width() > 1200) {
            $image->scale(width: 1200);
        }

        // 4. Encode ke JPEG dengan kualitas 75%
        $encoded = $image->toJpeg($quality);

        // 5. Buat nama file unik
        $filename = uniqid() . '_' . time() . '.jpg';
        $fullPath = $path . '/' . $filename;

        // 6. Simpan ke Storage
        Storage::put($fullPath, (string) $encoded);

        // 7. Kembalikan path untuk database (ganti public/ jadi storage/)
        return str_replace('public/', 'storage/', $fullPath);
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission.']);
        }

        // Validasi
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'category'   => 'required|string|max:100',
            'time_read'  => 'required|integer|min:1',
            'content'    => 'required|string',
            // Max size dinaikkan ke 5MB (5120) karena kita akan compress di server
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', 
        ]);

        try {
            // [Fitur 1: Generate Slug dari Title]
            $validated['slug'] = Str::slug($request->title);

            // Cek unik slug (tambah angka jika sudah ada)
            $count = Blogs::where('slug', 'like', $validated['slug'] . '%')->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }

            // [Fitur 2: Upload & Compress Image]
            if ($request->hasFile('image_path')) {
                // Panggil fungsi helper processImage
                $validated['image_path'] = $this->processImage($request->file('image_path'));
            }

            $blog = Blogs::create($validated);

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Added blog post: "' . $blog->title . '"',
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

        $blog = Blogs::findOrFail($blog_id);

        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'category'   => 'required|string|max:100',
            'time_read'  => 'required|integer|min:1',
            'content'    => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        try {
            // [Fitur 1: Update Slug jika Title Berubah]
            if ($blog->title !== $request->title) {
                $validated['slug'] = Str::slug($request->title);
                
                // Cek unik (kecuali diri sendiri)
                $count = Blogs::where('slug', 'like', $validated['slug'] . '%')
                              ->where('blog_id', '!=', $blog_id)
                              ->count();
                if ($count > 0) {
                    $validated['slug'] .= '-' . ($count + 1);
                }
            }

            // [Fitur 2: Update & Compress Image]
            if ($request->hasFile('image_path')) {
                // Hapus gambar lama
                if ($blog->image_path) {
                    $oldPath = str_replace('storage/', 'public/', $blog->image_path);
                    if (Storage::exists($oldPath)) {
                        Storage::delete($oldPath);
                    }
                }
                
                // Compress gambar baru
                $validated['image_path'] = $this->processImage($request->file('image_path'));
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