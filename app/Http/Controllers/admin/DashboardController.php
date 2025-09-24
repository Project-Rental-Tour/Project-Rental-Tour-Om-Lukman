<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Profile;
use App\Models\User;
use App\Models\Destination;
use App\Models\Booking;
use App\Models\BookingCar;
use App\Models\Car;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\LogActivity;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $profile = Profile::first();

        $profiles = Profile::find(1) ?? Profile::first();

        // Hitung data dari database
        $totalUsers = User::count();
        $totalDestinations = Destination::count();
        $totalBookings = Booking::count();
        $totalGalleries = Gallery::count();
        $totalTestimonials = Testimonial::count();
        $totalCars = Car::count();
        $totalCarBookings = BookingCar::count();

        $recentBookings = Booking::latest()->take(4)->get();


        $recentActivities = LogActivity::latest()->take(27)->get();

        $notifications = LogActivity::where('action', 'like', '%Submitted custom trip request%')
            ->orWhere('action', 'like', '%Submitted regular booking%')
            ->latest()
            ->take(10)
            ->get();

        LogActivity::create([
            'username' => $currentUser->username,
            'action' => 'Viewed Dashboard list (filtered: ' . ($request->filled('search') ? 'yes' : 'no') . ')'
        ]);


        return view('Admin.Dashboard', compact(
            'profile',
            'totalUsers',
            'totalDestinations',
            'totalBookings',
            'totalGalleries',
            'totalTestimonials',
            'recentBookings',
            'recentActivities',
            'notifications',
            'profiles',
            'totalCars',
            'totalCarBookings'
        ));
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
            'website_name' => 'nullable|string|max:255',
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

        try {
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

            return redirect()->route('dashboard.index')->with('toast', ['type' => 'success', 'message' => 'Success update profile']);
        } catch (\Exception $e) {
            return redirect()->back()->with('toast', ['type' => 'danger', 'message' => 'Cant update profile because $e->message()']);
        }
    }
}
