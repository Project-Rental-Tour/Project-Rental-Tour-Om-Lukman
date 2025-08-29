<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\LogActivity;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', [
                'type' => 'error',
                'message' => 'You do not have permission to view this page.'
            ]);
        }

        $query = Booking::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('country', 'like', "%{$search}%")
                ->orWhere('travel_date', 'like', "%{$search}%")
                ->orWhere('message', 'like', "%{$search}%")
                ->orWhere('destination_name', 'like', "%{$search}%");
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name-asc':
                $query->orderBy(DB::raw("CONCAT(first_name, ' ', last_name)"), 'asc');
                break;
            case 'name-desc':
                $query->orderBy(DB::raw("CONCAT(first_name, ' ', last_name)"), 'desc');
                break;
            case 'email-asc':
                $query->orderBy('email', 'asc');
                break;
            case 'email-desc':
                $query->orderBy('email', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $bookings = $query->paginate(25)->appends($request->except('page'));

        $notifications = LogActivity::where('action', 'like', '%Submitted custom trip request%')
            ->orWhere('action', 'like', '%Submitted regular booking%')
            ->latest()
            ->take(10)
            ->get();

        LogActivity::create([
            'username' => $currentUser->username,
            'action' => 'Viewed Booking list (filtered: ' . ($request->filled('search') ? 'yes' : 'no') . ')'
        ]);

        return view('admin.manageBooking', compact('bookings', 'notifications'));
    }

    public function showRegularForm($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();

        return view('client.regularBooking', compact('destination'));
    }

    public function bookingRegular(Request $request)
    {
        $destination = Destination::findOrFail($request->destination_id);

        preg_match('/(\d+)\s*nights?/i', $destination->time, $matches);
        $nights = $matches[1] ?? null;

        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,destination_id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:bookings,email',
            'country' => 'required|string|max:255',
            'country_code' => 'required|string|max:10',
            'phone_number' => 'required|string|max:15',
            'travel_date' => 'required|date|after_or_equal:today',
            'message' => 'nullable|string|max:1000',
        ]);

        // Gabungkan country code dan phone number
        $fullPhoneNumber = $validated['country_code'] . ltrim($validated['phone_number'], '0');

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
            'phone_number' => $fullPhoneNumber,
            'message' => $validated['message'],
            'custom_destinations' => null,
            'interests' => null,
            'travelers' => 1,
            'budget_range' => null,
        ]);

        $fullName = $booking->first_name . ' ' . $booking->last_name;

        LogActivity::create([
            'username' => $fullName,
            'action' => "Submitted regular booking for {$booking->destination_name} on {$booking->travel_date}"
        ]);

        $durationNights = $booking->duration_nights ?? 'N/A';
        $messageText = $booking->message ? "<b>Message:</b> " . htmlspecialchars($booking->message) . "\n" : "";

        $this->sendTelegramNotification(
            "✅ <b>New Regular Booking!</b>\n\n" .
                "<b>Name:</b> {$booking->first_name} {$booking->last_name}\n" .
                "<b>Email:</b> {$booking->email}\n" .
                "<b>Phone:</b> <a href='https://wa.me/{$booking->phone_number}'>{$booking->phone_number}</a>\n" .
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
        return view('client.customBooking');
    }

    public function bookingCustom(Request $request)
    {
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
            'country_code' => 'required|string|max:10',
            'phone_number' => 'required|string|max:15',
            'message' => 'nullable|string|max:1000',
        ]);

        $fullPhoneNumber = $validated['country_code'] . ltrim($validated['phone_number'], '0');

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
            'phone_number' => $fullPhoneNumber,
            'message' => $validated['message'],
            'custom_destinations' => $validated['custom_destinations'],
            'interests' => $validated['interests'] ?? null,
            'travelers' => $validated['travelers'],
            'budget_range' => $validated['budget_range'],
        ]);

        $fullName = $booking->first_name . ' ' . $booking->last_name;
        $interests = $booking->interests ? implode(', ', $booking->interests) : 'Not specified';

        LogActivity::create([
            'username' => $fullName,
            'action' => "Submitted custom trip request for: {$booking->custom_destinations} (Travelers: {$booking->travelers}, Budget: {$booking->budget_range})"
        ]);

        $durationNights = $booking->duration_nights ?? 'Not specified';
        $budgetRange = $booking->budget_range ?? 'Not specified';
        $messageText = $booking->message ? "<b>Message:</b> " . htmlspecialchars($booking->message) . "\n" : '';

        $this->sendTelegramNotification(
            "✨ <b>New Custom Trip Request!</b>\n\n" .
                "<b>Name:</b> {$booking->first_name} {$booking->last_name}\n" .
                "<b>Email:</b> {$booking->email}\n" .
                "<b>Phone:</b> <a href='https://wa.me/{$booking->phone_number}'>{$booking->phone_number}</a>\n" .
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

        return redirect()->route('index')
            ->with('toast', ['type' => 'success', 'message' => 'Custom trip request sent! We’ll design your dream package.']);
    }

    public function sendTelegramNotification($message)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        try {
            $response = Http::timeout(15)->post($url, [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
            ]);

            if ($response->successful() && $response->json('ok') === true) {
                Log::info('✅ Telegram Notification Sent Successfully', [
                    'chat_id' => $chatId,
                    'message_preview' => substr(strip_tags($message), 0, 100) . '...'
                ]);
                return true;
            } else {
                $errorCode = $response->json('error_code');
                $description = $response->json('description');
                Log::error('❌ Telegram API Error', [
                    'error_code' => $errorCode,
                    'description' => $description,
                    'chat_id' => $chatId,
                    'url' => $url
                ]);
                return false;
            }
        } catch (\Exception $e) {
            // 🔴 Cetak error jaringan (timeout, SSL, blocked, dll)
            Log::error('🚨 Telegram Notification Failed (Network/Connection)', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'chat_id' => $chatId
            ]);
            return false;
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

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:bookings,booking_id',
        ]);

        try {
            $bookings = Booking::whereIn('booking_id', $request->ids)->get();
            $count = $bookings->count();

            if ($count === 0) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'No bookings selected.'
                ]);
            }

            Booking::whereIn('booking_id', $request->ids)->delete();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Bulk deleted {$count} booking(s): " . $bookings->map(fn($b) => $b->first_name . ' ' . $b->last_name)->join(', ')
            ]);

            if (!$request->expectsJson()) {
                return redirect()->route('manage-booking.index')->with('toast', [
                    'type' => 'success',
                    'message' => "Successfully deleted {$count} booking(s)."
                ]);
            }

            return response()->json([
                'success' => true,
                'toast' => [
                    'type' => 'success',
                    'message' => "Successfully deleted {$count} booking(s)."
                ]
            ]);
        } catch (\Exception $e) {
            if (!$request->expectsJson()) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'Failed to bulk delete bookings: ' . $e->getMessage()
                ]);
            }

            return response()->json([
                'success' => false,
                'toast' => [
                    'type' => 'error',
                    'message' => 'Failed to bulk delete bookings: ' . $e->getMessage()
                ]
            ], 500);
        }
    }
}
