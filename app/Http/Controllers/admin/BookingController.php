<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'You do not have permission to view this page.']);
        }

        $bookings = Booking::paginate(25);; // Assuming you have a Booking model
        return view('admin.manageBooking', compact('bookings'));
    }

    public function bookingUser(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'You do not have permission to view this page.']);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:bookings,email',
            'country' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        Booking::create($validated);

        return redirect()->route('')->with('success', 'Booking created successfully.');
    }
}
