<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        $testimonials = Testimonial::paginate(25);

        if (!$currentUser) {
            return redirect()->route('login')
                ->withErrors(['error' => 'You need to login first']);
        }

        return view('admin.Testimonial', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);

        Testimonial::create($validate);

        return redirect()->route('testimoni.index')->with('success', 'done send testimoni');
    }
}
