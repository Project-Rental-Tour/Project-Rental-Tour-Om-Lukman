<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Profile;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $profile = Profile::first();


        return view('admin.Dashboard', compact('profile'));
    }

    public function update(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $profile = Profile::first();

        if (!$profile) {
            $profile = new Profile();
        }

        // validasi
        $request->validate([
            'website_name' => 'required|string|max:255',
            'website_logo_light' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'website_logo_dark' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'jumbotron_heading' => 'nullable|string|max:255',
            'jumbotron_subheading' => 'nullable|string',
            'jumbotron_image' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'about_heading' => 'nullable|string|max:255',
            'about_description' => 'nullable|string',
            'address' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'phone_number' => 'nullable|string',
            'facebook_link' => 'nullable|string',
            'instagram_link' => 'nullable|string',
            'operating_hours' => 'nullable|string',
        ]);

        // upload logo light
        if ($request->hasFile('website_logo_light')) {
            if ($profile->website_logo_light) {
                Storage::delete($profile->website_logo_light);
            }
            $profile->website_logo_light = $request->file('website_logo_light')->store('logos', 'public');
        }

        // upload logo dark
        if ($request->hasFile('website_logo_dark')) {
            if ($profile->website_logo_dark) {
                Storage::delete($profile->website_logo_dark);
            }
            $profile->website_logo_dark = $request->file('website_logo_dark')->store('logos', 'public');
        }


        // upload jumbotron image
        if ($request->hasFile('jumbotron_image')) {
            if ($profile->jumbotron_image) {
                Storage::delete($profile->jumbotron_image);
            }
            $profile->jumbotron_image = $request->file('jumbotron_image')->store('jumbotrons', 'public');
        }

        // isi field lain
        $profile->website_name = $request->website_name;
        $profile->jumbotron_heading = $request->jumbotron_heading;
        $profile->jumbotron_subheading = $request->jumbotron_subheading;
        $profile->about_heading = $request->about_heading;
        $profile->about_description = $request->about_description;
        $profile->address = $request->address;
        $profile->contact_email = $request->contact_email;
        $profile->phone_number = $request->phone_number;
        $profile->facebook_link = $request->facebook_link;
        $profile->instagram_link = $request->instagram_link;
        $profile->operating_hours = $request->operating_hours;

        $profile->save();

        return redirect()->route('dashboard.index')->with('success', 'Profile berhasil diperbarui');
    }
}
