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
                $imagePath = $request->file('featured_image')->store('blogs', 'public');
            } else {
                return back()->withInput()->with('toast', [
                    'type' => 'error',
                    'message' => 'Featured image is required'
                ]);
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

            // Dapatkan username dari user yang login
            $user = Auth::user();
            $author = $user->name ?? $user->username ?? $user->email ?? 'Unknown Author';

            // Simpan data
            $blogPost = BlogPost::create([
                'title' => $validatedData['title'],
                'author' => $author,
                'slug' => $slug,
                'content' => $validatedData['content'],
                'featured_image' => $imagePath
            ]);

            return redirect()->route('manage-blog.index')
                ->with('toast', ['type' => 'success', 'message' => 'Blog post created successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to create blog post: ' . $e->getMessage()]);
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
                if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                    Storage::disk('public')->delete($blogPost->featured_image);
                }
                $imagePath = $request->file('featured_image')->store('blogs', 'public');
                $blogPost->featured_image = $imagePath;
            }

            // Update data
            $blogPost->title = $validatedData['title'];
            $blogPost->content = $validatedData['content'];

            // Update slug hanya jika title berubah
            if ($blogPost->isDirty('title')) {
                $slug = Str::slug($validatedData['title']);

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

            return redirect()->route('manage-blog.index')
                ->with('toast', ['type' => 'success', 'message' => 'Blog post updated successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to update blog post: ' . $e->getMessage()]);
        }
    }

    public function destroy($blog_post_id)
    {
        try {
            $blogPost = BlogPost::findOrFail($blog_post_id);

            if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }

            $blogPost->delete();

            return redirect()->route('manage-blog.index')
                ->with('toast', ['type' => 'success', 'message' => 'Blog post deleted successfully']);
        } catch (\Exception $e) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Failed to delete blog post: ' . $e->getMessage()
            ]);
        }
    }

    public function bulkDestroy(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:blog_posts,blog_post_id',
        ]);

        try {
            // Get all blog posts with the given IDs
            $posts = BlogPost::whereIn('blog_post_id', $validated['ids'])->get();

            if ($posts->isEmpty()) {
                return redirect()->back()
                    ->with('toast', [
                        'type' => 'error',
                        'message' => 'No valid blog posts found to delete.'
                    ]);
            }

            $deletedCount = 0;
            foreach ($posts as $post) {
                // Delete the featured image if it exists
                if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                    Storage::disk('public')->delete($post->featured_image);
                }

                // Delete the post
                $post->delete();
                $deletedCount++;
            }

            return redirect()->route('manage-blog.index')
                ->with('toast', [
                    'type' => 'success',
                    'message' => $deletedCount . ' blog post(s) deleted successfully.'
                ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('toast', [
                    'type' => 'error',
                    'message' => 'Failed to delete blog posts: ' . $e->getMessage()
                ]);
        }
    }
}
