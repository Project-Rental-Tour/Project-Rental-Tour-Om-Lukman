<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\BlogPost;
use App\Models\LogActivity;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

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
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

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

            $blogPost = BlogPost::create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'featured_image' => $imagePath,
                'type' => $validatedData['type'],
                'reading_time' => $validatedData['reading_time'],
                'slug' => $slug,
                'author' => $author,
            ]);

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Created blog post: "' . Str::limit($blogPost->title, 50) . '" (Type: ' . $blogPost->type . ')',
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
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|max:50',
            'reading_time' => 'required|integer|min:1|max:120',
        ]);

        try {
            $blogPost = BlogPost::findOrFail($blog_post_id);

            // Simpan data lama untuk log
            $oldTitle = $blogPost->title;
            $oldType = $blogPost->type;

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

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Updated blog post: '{$oldTitle}' → '{$blogPost->title}' (Type: {$oldType} → {$blogPost->type})",
            ]);

            return redirect()->route('manage-blog.index')
                ->with('toast', ['type' => 'success', 'message' => 'Blog post updated successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to update blog post: ' . $e->getMessage()]);
        }
    }

    public function destroy($blog_post_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        try {
            $blogPost = BlogPost::findOrFail($blog_post_id);

            $deletedTitle = $blogPost->title;
            $deletedType = $blogPost->type;

            if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }

            $blogPost->delete();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Deleted blog post: '{$deletedTitle}' (Type: {$deletedType})",
            ]);

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
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', [
                'type' => 'error',
                'message' => 'You do not have permission to view this page.'
            ]);
        }

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:blog_posts,blog_post_id',
        ]);

        try {
            $posts = BlogPost::whereIn('blog_post_id', $validated['ids'])->get();

            if ($posts->isEmpty()) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'No valid blog posts found to delete.'
                ]);
            }

            $deletedTitles = [];
            foreach ($posts as $post) {
                if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                    Storage::disk('public')->delete($post->featured_image);
                }
                $deletedTitles[] = $post->title;
                $post->delete();
            }

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Bulk deleted " . count($deletedTitles) . " blog post(s): " . implode(', ', $deletedTitles),
            ]);

            if (!$request->expectsJson()) {
                return redirect()->route('manage-blog.index')->with('toast', [
                    'type' => 'success',
                    'message' => count($deletedTitles) . ' blog post(s) deleted successfully.'
                ]);
            }

            return response()->json([
                'success' => true,
                'toast' => [
                    'type' => 'success',
                    'message' => count($deletedTitles) . ' blog post(s) deleted successfully.'
                ]
            ]);
        } catch (\Exception $e) {
            if (!$request->expectsJson()) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'Failed to delete blog posts: ' . $e->getMessage()
                ]);
            }

            return response()->json([
                'success' => false,
                'toast' => [
                    'type' => 'error',
                    'message' => 'Failed to delete blog posts: ' . $e->getMessage()
                ]
            ], 500);
        }
    }
}
