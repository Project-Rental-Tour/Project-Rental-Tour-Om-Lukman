<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::paginate(25);
        return view('admin.manageBlog', compact('blogPosts'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Upload gambar
            if ($request->hasFile('featured_image')) {
                $imagePath = $request->file('featured_image')->store('blog-images', 'public');
            } else {
                return back()->withInput()->with('error', 'Featured image is required');
            }

            // Generate slug dari title
            $slug = Str::slug($validatedData['title']);

            // Cek jika slug sudah ada, tambahkan angka unik
            $originalSlug = $slug;
            $counter = 1;
            while (BlogPost::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Dapatkan username dari user yang login - PERBAIKAN DI SINI
            $user = Auth::user();
            $author = $user->name ?? $user->username ?? $user->email ?? 'Unknown Author';

            // Simpan data - PASTIKAN AUTHOR DIMASUKKAN
            $blogPost = BlogPost::create([
                'title' => $validatedData['title'],
                'author' => $author, // PASTIKAN INI ADA
                'slug' => $slug,
                'content' => $validatedData['content'],
                'featured_image' => $imagePath
            ]);

            return redirect()->route('manage-blog.index')
                ->with('success', 'Blog post created successfully');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to create blog post: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $blog_post_id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $blogPost = BlogPost::findOrFail($blog_post_id);

            // Handle upload gambar jika ada
            if ($request->hasFile('featured_image')) {
                // Hapus gambar lama jika ada
                if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                    Storage::disk('public')->delete($blogPost->featured_image);
                }
                $imagePath = $request->file('featured_image')->store('blog-images', 'public');
                $blogPost->featured_image = $imagePath;
            }

            // Update data
            $blogPost->title = $validatedData['title'];
            $blogPost->content = $validatedData['content'];

            // Update slug hanya jika title berubah
            if ($blogPost->isDirty('title')) {
                $slug = Str::slug($validatedData['title']);

                // Cek slug unik
                $originalSlug = $slug;
                $counter = 1;
                while (BlogPost::where('slug', $slug)
                    ->where('blog_post_id', '!=', $blog_post_id)
                    ->exists()
                ) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $blogPost->slug = $slug;
            }

            $blogPost->save();

            // PERBAIKAN DI SINI: Redirect ke index, bukan show
            return redirect()->route('manage-blog.index')
                ->with('success', 'Blog post berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui blog post: ' . $e->getMessage());
        }
    }

    public function destroy($blog_post_id)
    {
        try {
            $blogPost = BlogPost::findOrFail($blog_post_id);

            // Hapus gambar dari storage
            if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }

            $blogPost->delete();

            return redirect()->route('manage-blog.index')
                ->with('success', 'Blog post berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus blog post: ' . $e->getMessage());
        }
    }

    public function bulkDestroy(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:blog_posts,blog_post_id'
        ]);

        try {
            $deletedCount = 0;

            foreach ($validatedData['ids'] as $id) {
                $blogPost = BlogPost::find($id);

                if ($blogPost) {
                    // Hapus gambar dari storage
                    if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                        Storage::disk('public')->delete($blogPost->featured_image);
                    }

                    $blogPost->delete();
                    $deletedCount++;
                }
            }

            return response()->json([
                'success' => true,
                'message' => $deletedCount . ' blog post berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus blog posts: ' . $e->getMessage()
            ], 500);
        }
    }
}
