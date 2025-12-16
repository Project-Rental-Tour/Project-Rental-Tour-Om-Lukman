<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Profile;

class UserBlogController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data Profile (Biasanya untuk Footer/Contact info)
        $profiles = Profile::find(1) ?? Profile::first();

        // 2. Inisiasi Query
        $query = Blogs::query();

        // 3. Logika Search (Judul, Konten, atau Kategori)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
        }

        // 4. Logika Filter Kategori (Jika user klik kategori tertentu)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // 5. Ambil data (Urutkan dari yang terbaru, Pagination 9 item per halaman)
        $blogs = $query->orderBy('created_at', 'desc')
                       ->paginate(9)
                       ->appends($request->except('page'));

        // 6. Ambil Recent Posts (Opsional: untuk widget "Artikel Terbaru" di sidebar)
        $recentPosts = Blogs::latest()->take(5)->get();

        return view('Client.blogPage', compact('blogs', 'profiles', 'recentPosts'));
    }

    public function detailBlog($title)
    {
        $profiles = Profile::find(1) ?? Profile::first();

        // Cari berdasarkan kolom 'title'
        // firstOrFail() akan otomatis return 404 jika judul tidak ditemukan
        $blog = Blogs::where('title', $title)->firstOrFail(); 

        // Artikel Terkait (Kecuali artikel yang sedang dibuka)
        $relatedPosts = Blogs::where('blog_id', '!=', $blog->blog_id)
                             ->inRandomOrder()
                             ->take(3)
                             ->get();

        return view('Client.detailBlog', compact('blog', 'profiles', 'relatedPosts'));
    }
}