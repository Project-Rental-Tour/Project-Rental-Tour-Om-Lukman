<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Booking;
use App\Models\Destination;

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

    public function bookingRegular(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'You need to login to book.']);
        }

        $destination = Destination::findOrFail($request->destination_id);

        preg_match('/(\d+)\s*nights?/i', $destination->time, $matches);
        $nights = $matches[1] ?? null;

        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,destination_id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:bookings,email',
            'country' => 'required|string|max:255',
            'travel_date' => 'required|date|after_or_equal:today',
            'message' => 'nullable|string|max:1000',
        ]);

        $booking = Booking::create([
            'destination_id' => $validated['destination_id'],
            'destination_name' => $destination->name_package,
            'travel_date' => $validated['travel_date'],
            'duration_nights' => $nights,
            'package_type' => 'regular',
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'country' => $validated['country'],
            'message' => $validated['message'],
            'custom_destinations' => null,
            'interests' => null,
            'travelers' => 1,
            'budget_range' => null,
        ]);

        // ✅ Gunakan variabel sementara
        $durationNights = $booking->duration_nights ?? 'N/A';
        $messageText = $booking->message ? "<b>Message:</b> " . htmlspecialchars($booking->message) . "\n" : "";

        $this->sendTelegramNotification(
            "✅ <b>New Regular Booking!</b>\n\n" .
                "<b>Name:</b> {$booking->first_name} {$booking->last_name}\n" .
                "<b>Email:</b> {$booking->email}\n" .
                "<b>Destination:</b> {$booking->destination_name}\n" .
                "<b>Travel Date:</b> {$booking->travel_date}\n" .
                "<b>Nights:</b> {$durationNights}\n" .
                "<b>Country:</b> {$booking->country}\n" .
                $messageText .
                "\n📅 <i>Booked at: " . now()->format('M d, Y H:i') . "</i>"
        );

        return redirect()->route('destination.show', $destination->slug)
            ->with('toast', ['type' => 'success', 'message' => 'Booking submitted! We will contact you soon.']);
    }

    public function showCustomForm()
    {
        return view('user.custom-trip');
    }

    public function bookingCustom(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'You need to login to request a custom trip.']);
        }

        $validated = $request->validate([
            'custom_destinations' => 'required|string|max:500',
            'travel_date' => 'required|date|after_or_equal:today',
            'duration_nights' => 'nullable|integer|min:1|max:60',
            'travelers' => 'required|integer|min:1|max:20',
            'budget_range' => 'nullable|string|max:50',
            'interests' => 'nullable|array',
            'interests.*' => 'string|max:50',

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:bookings,email',
            'country' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        // ✅ Simpan hasil create ke variabel $booking
        $booking = Booking::create([
            'destination_id' => null,
            'destination_name' => 'Custom Trip Request',
            'travel_date' => $validated['travel_date'],
            'duration_nights' => $validated['duration_nights'],
            'package_type' => 'custom',

            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'country' => $validated['country'],
            'message' => $validated['message'],

            'custom_destinations' => $validated['custom_destinations'],
            'interests' => $validated['interests'] ?? null,
            'travelers' => $validated['travelers'],
            'budget_range' => $validated['budget_range'],
        ]);

        // ✅ Sekarang $booking sudah ada, aman dipakai
        $interests = $booking->interests ? implode(', ', $booking->interests) : 'Not specified';
        $durationNights = $booking->duration_nights ?? 'Not specified';
        $budgetRange = $booking->budget_range ?? 'Not specified';
        $messageText = $booking->message ? "<b>Message:</b> " . htmlspecialchars($booking->message) . "\n" : '';

        // ✅ Kirim notifikasi
        $this->sendTelegramNotification(
            "✨ <b>New Custom Trip Request!</b>\n\n" .
                "<b>Name:</b> {$booking->first_name} {$booking->last_name}\n" .
                "<b>Email:</b> {$booking->email}\n" .
                "<b>Destinations:</b> {$booking->custom_destinations}\n" .
                "<b>Travel Date:</b> {$booking->travel_date}\n" .
                "<b>Nights:</b> {$durationNights}\n" .
                "<b>Travelers:</b> {$booking->travelers}\n" .
                "<b>Budget:</b> {$budgetRange}\n" .
                "<b>Interests:</b> {$interests}\n" .
                "<b>Country:</b> {$booking->country}\n" .
                $messageText .
                "\n📅 <i>Requested at: " . now()->format('M d, Y H:i') . "</i>"
        );

        return redirect()->route('booking.custom')
            ->with('toast', ['type' => 'success', 'message' => 'Custom trip request sent! We’ll design your dream package.']);
    }

    protected function sendTelegramNotification($message)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        try {
            \Illuminate\Support\Facades\Http::post($url, [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Telegram Notification Failed: ' . $e->getMessage());
        }
    }

    public function bulkDestroy(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'toast' => ['type' => 'error', 'message' => 'Unauthorized access']
            ], 401);
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:bookings,booking_id',
        ]);

        try {
            $count = Booking::whereIn('booking_id', $request->ids)->count();
            Booking::whereIn('booking_id', $request->ids)->delete();

            return response()->json([
                'success' => true,
                'toast' => ['type' => 'success', 'message' => "Successfully deleted {$count} booking(s)."]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'toast' => ['type' => 'error', 'message' => 'Failed to bulk delete bookings: ' . $e->getMessage()]
            ], 500);
        }
    }
}
