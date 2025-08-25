<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Testimonial;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('login')->withErrors(['error' => 'You need to login first.']);
        }

        $testimonials = Testimonial::latest()->paginate(10);

        return view('admin.manageTestimonial', compact('testimonials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'role'      => 'required|string|max:255',
            'location'  => 'required|string|max:255',
            'content'   => 'required|string',
            'rating'    => 'required|integer|between:1,5',
        ])->validate();


        Testimonial::create([
            'name'       => $validatedData['name'],
            'role'       => $validatedData['role'],
            'location'   => $validatedData['location'],
            'content'    => $validatedData['content'],
            'rating'     => $validatedData['rating'],
            'user_id'    => Auth::id(),
        ]);

        return redirect()->route('manage-testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $testimonial_id)
    {
        $testimonial = Testimonial::findOrFail($testimonial_id);

        $validatedData = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'role'      => 'required|string|max:255',
            'location'  => 'required|string|max:255',
            'content'   => 'required|string',
            'rating'    => 'required|integer|between:1,5',
        ])->validate();

        // Update menggunakan assignment (seperti BlogPost)
        $testimonial->name       = $validatedData['name'];
        $testimonial->role       = $validatedData['role'];
        $testimonial->location   = $validatedData['location'];
        $testimonial->content    = $validatedData['content'];
        $testimonial->rating     = $validatedData['rating'];
        $testimonial->save();

        return redirect()->route('manage-testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($testimonial_id)
    {
        $testimonial = Testimonial::findOrFail($testimonial_id);
        $testimonial->delete();

        return redirect()->route('manage-testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }

    /**
     * Remove multiple resources.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:testimonials,testimonial_id',
        ]);

        Testimonial::whereIn('testimonial_id', $request->ids)->delete();

        return redirect()->route('manage-testimonials.index')->with('success', 'Selected testimonials deleted successfully.');
    }
}
