<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Gallery;
use App\Models\Profile;

class UserGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at')->get();
        $profiles = Profile::find(1) ?? Profile::first();
        return view('Client.galleryPage', compact('galleries', 'profiles'));
    }
}
