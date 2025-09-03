<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\BlogPost;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\Gallery;
use App\Models\Profile;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $testimonials = Testimonial::orderBy('created_at')->get();
        $galleries = Gallery::orderBy('created_at')->get();
        $destinations = Destination::orderBy('created_at')->get();
        $profiles = Profile::find(1);

        $latestGalleries = Gallery::orderBy('created_at', 'desc')->take(3)->get();
        $query = BlogPost::query();

        // Filter by type jika ada
        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->type . '%');
        }

        // Ambil 3 terbaru
        $blogs = $query->latest()->take(3)->get();

        // Untuk filter button
        $types = BlogPost::whereNotNull('type')->distinct()->pluck('type');

        return view('Client.Home', compact('blogs', 'types', 'testimonials', 'galleries', 'destinations', 'profiles', 'latestGalleries'));
    }
}
