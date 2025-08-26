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
    public function index(Request $request)
    {
        $query = BlogPost::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhere('reading_time', 'like', "%{$search}%");
        }

        // Sort
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

        $blogPosts = $query->paginate(25)->appends($request->except('page'));
        return view('admin.manageBlog', compact('blogPosts'));
    }

    public function detailBlog()
    {
        return view('client.detailBlog');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|max:50',
            'reading_time' => 'required|integer|min:1|max:120',
        ]);

        try {
            $imagePath = $request->file('featured_image')->store('blogs', 'public');

            $slug = Str::slug($validatedData['title']);
            $originalSlug = $slug;
            $counter = 1;
            while (BlogPost::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $user = Auth::user();
            $author = $user->name ?? $user->username ?? $user->email ?? 'Unknown Author';

            BlogPost::create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'featured_image' => $imagePath,
                'type' => $validatedData['type'],
                'reading_time' => $validatedData['reading_time'],
                'slug' => $slug,
                'author' => $author,
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|max:50',
            'reading_time' => 'required|integer|min:1|max:120',
        ]);

        try {
            $blogPost = BlogPost::findOrFail($blog_post_id);

            if ($request->hasFile('featured_image')) {
                if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                    Storage::disk('public')->delete($blogPost->featured_image);
                }
                $blogPost->featured_image = $request->file('featured_image')->store('blogs', 'public');
            }

            $blogPost->title = $validatedData['title'];
            $blogPost->content = $validatedData['content'];
            $blogPost->type = $validatedData['type'];
            $blogPost->reading_time = $validatedData['reading_time'];

            if ($blogPost->isDirty('title')) {
                $slug = Str::slug($validatedData['title']);
                $originalSlug = $slug;
                $counter = 1;
                while (BlogPost::where('slug', $slug)
                    ->where('blog_post_id', '!=', $blog_post_id)
                    ->exists()
                ) {
                    $slug = $originalSlug . '-' . $counter++;
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
