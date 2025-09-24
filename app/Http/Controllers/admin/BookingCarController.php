<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\BookingCar;
use App\Models\Car;
use App\Models\LogActivity;
use App\Models\Profile;

class BookingCarController extends Controller
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

        $query = BookingCar::with('car');
        $profiles = Profile::find(1) ?? Profile::first();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name-asc':
                $query->orderBy('customer_name', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('customer_name', 'desc');
                break;
            case 'date-asc':
                $query->orderBy('start_date', 'asc');
                break;
            case 'date-desc':
                $query->orderBy('start_date', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $notifications = LogActivity::where('action', 'like', '%Submitted custom trip request%')
            ->orWhere('action', 'like', '%Submitted regular booking%')
            ->orWhere('action', 'like', '%New Car Booking%')
            ->latest()
            ->take(10)
            ->get();

        LogActivity::create([
            'username' => $currentUser->username,
            'action' => 'Viewed Car Booking list (filtered: ' . ($request->filled('search') ? 'yes' : 'no') . ')'
        ]);

        $bookings = $query->paginate(25)->appends($request->except('page'));
        return view('Admin.manageBookingCar', compact('bookings', 'notifications', 'profiles'));
    }

    public function booking($slug)
    {
        $profiles = Profile::find(1) ?? Profile::first();
        $car = Car::where('slug', $slug)->firstOrFail();
        return view('Client.bookingCar', compact('profiles', 'car'));
    }

    public function bookingStore(Request $request)
    {


        $validated = $request->validate([
            'car_id'        => 'required|exists:cars,car_id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
            'rental_type'   => 'nullable|boolean',
            'booking_status' => 'nullable|string|in:pending,confirmed,cancelled',
            'notes'         => 'nullable|string',
        ]);

        try {
            $car = Car::findOrFail($validated['car_id']);

            $startDate = \Carbon\Carbon::parse($validated['start_date']);
            $endDate = \Carbon\Carbon::parse($validated['end_date']);
            $durationDays = $startDate->diffInDays($endDate);

            $totalPrice = $car->price * $durationDays;

            $booking = BookingCar::create([
                'car_id'        => $validated['car_id'],
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'],
                'start_date'    => $validated['start_date'],
                'end_date'      => $validated['end_date'],
                'duration_days' => $durationDays,
                'total_price'   => $totalPrice,
                'rental_type'   => $validated['rental_type'],
                'booking_status' => $validated['booking_status'] ?? 'pending',
                'notes'         => $validated['notes'],
            ]);

            LogActivity::create([
                'username' => $request->customer_name,
                'action'   => "New Car Booking: {$booking->customer_name} for {$car->name_car} ({$startDate->format('M d')} - {$endDate->format('M d')})"
            ]);

            $this->sendTelegramNotification(
                "🚗 <b>New Car Booking!</b>\n\n" .
                    "<b>Customer:</b> {$booking->customer_name}\n" .
                    "<b>Phone:</b> <a href='https://wa.me/{$booking->customer_phone}'>{$booking->customer_phone}</a>\n" .
                    "<b>Email:</b> " . ($booking->customer_email ?? 'Not provided') . "\n" .
                    "<b>Car:</b> {$car->name_car}\n" .
                    "<b>Rental Type:</b> " . ($booking->rental_type ? 'With Driver' : 'Self Drive') . "\n" .
                    "<b>Duration:</b> {$booking->duration_days} days\n" .
                    "<b>Total Price:</b> Rp" . number_format($booking->total_price, 0, ',', '.') . "\n" .
                    "<b>Travel Dates:</b> " . \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') . " to " . \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') . "\n" .
                    "<b>Status:</b> {$booking->booking_status}\n" .
                    ($booking->notes ? "<b>Notes:</b> " . htmlspecialchars($booking->notes) . "\n" : "") .
                    "\n📅 <i>Booked at: " . now()->format('M d, Y H:i') . "</i>"
            );

            return redirect()->route('index')
                ->with('toast', ['type' => 'success', 'message' => 'Car booking created successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to create booking: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $booking_cars_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', [
                'type' => 'error',
                'message' => 'You do not have permission to view this page.'
            ]);
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
            'rental_type'   => 'nullable|boolean',
            'booking_status' => 'required|string|in:pending,confirmed,cancelled',
            'notes'         => 'nullable|string',
        ]);

        try {
            $booking = BookingCar::findOrFail($booking_cars_id);
            $oldStatus = $booking->booking_status;
            $car = $booking->car;

            $startDate = \Carbon\Carbon::parse($validated['start_date']);
            $endDate = \Carbon\Carbon::parse($validated['end_date']);
            $durationDays = $startDate->diffInDays($endDate);

            $totalPrice = $car->price * $durationDays;

            $booking->update([
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'],
                'start_date'    => $validated['start_date'],
                'end_date'      => $validated['end_date'],
                'duration_days' => $durationDays,
                'total_price'   => $totalPrice,
                'rental_type'   => $validated['rental_type'],
                'booking_status' => $validated['booking_status'],
                'notes'         => $validated['notes'],
            ]);

            $statusChanged = $oldStatus !== $validated['booking_status'];
            $statusText = $statusChanged ? " (Status: {$oldStatus} → {$validated['booking_status']})" : "";

            LogActivity::create([
                'username' => $currentUser->username,
                'action'   => "Updated Car Booking for {$booking->customer_name}{$statusText}"
            ]);

            if ($statusChanged) {
                $emoji = $validated['booking_status'] === 'confirmed' ? '✅' : '❌';
                $this->sendTelegramNotification(
                    "{$emoji} <b>Car Booking Status Updated!</b>\n\n" .
                        "<b>Customer:</b> {$booking->customer_name}\n" .
                        "<b>Car:</b> {$car->name_car}\n" .
                        "<b>Previous Status:</b> {$oldStatus}\n" .
                        "<b>New Status:</b> {$validated['booking_status']}\n" .
                        "<b>Updated by:</b> {$currentUser->username}\n" .
                        "\n📅 <i>Updated at: " . now()->format('M d, Y H:i') . "</i>"
                );
            }

            return redirect()->route('manage-booking-car.index')
                ->with('toast', ['type' => 'success', 'message' => 'Car booking updated successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Update failed: ' . $e->getMessage()]);
        }
    }

    public function destroy($booking_cars_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', [
                'type' => 'error',
                'message' => 'You do not have permission to view this page.'
            ]);
        }

        try {
            $booking = BookingCar::findOrFail($booking_cars_id);
            $customerName = $booking->customer_name;
            $carName = $booking->car->name_car;

            $booking->delete();

            LogActivity::create([
                'username' => $currentUser->username,
                'action'   => "Deleted Car Booking: {$customerName} for {$carName}"
            ]);

            return redirect()->route('manage-booking-car.index')
                ->with('toast', ['type' => 'success', 'message' => 'Car booking deleted successfully']);
        } catch (\Exception $e) {
            return back()->with('toast', ['type' => 'error', 'message' => 'Delete failed: ' . $e->getMessage()]);
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

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:booking_cars,booking_cars_id',
        ]);

        try {
            $bookings = BookingCar::whereIn('booking_cars_id', $validated['ids'])->with('car')->get();

            if ($bookings->isEmpty()) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'No bookings selected.'
                ]);
            }

            $deletedNames = $bookings->map(fn($b) => "{$b->customer_name} ({$b->car->name_car})");
            $count = $bookings->count();

            foreach ($bookings as $booking) {
                $booking->delete();
            }

            LogActivity::create([
                'username' => $currentUser->username,
                'action'   => "Bulk deleted {$count} car booking(s): " . $deletedNames->join(', '),
            ]);

            if (!$request->expectsJson()) {
                return redirect()->route('manage-booking-car.index')->with('toast', [
                    'type' => 'success',
                    'message' => "{$count} car booking(s) deleted successfully."
                ]);
            }

            return response()->json([
                'success' => true,
                'toast'   => [
                    'type' => 'success',
                    'message' => "{$count} car booking(s) deleted successfully."
                ]
            ]);
        } catch (\Exception $e) {
            if (!$request->expectsJson()) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'Bulk delete failed: ' . $e->getMessage()
                ]);
            }

            return response()->json([
                'success' => false,
                'toast'   => [
                    'type' => 'error',
                    'message' => 'Bulk delete failed: ' . $e->getMessage()
                ]
            ], 500);
        }
    }

    public function sendTelegramNotification($message)
    {
        $token = config('telegram.bot_token');
        $chatId = config('telegram.chat_id');

        if (!$token || !$chatId) {
            Log::warning('Telegram credentials not configured');
            return false;
        }

        $url = "https://api.telegram.org/bot{$token}/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_TIMEOUT => 15,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_USERAGENT => 'Laravel Car Booking System',
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            Log::error('❌ Telegram Notification Failed (cURL)', [
                'error' => $error,
                'message' => $message,
                'chat_id' => $chatId,
            ]);
            return false;
        }

        $result = json_decode($response, true);

        if ($httpCode == 200 && isset($result['ok']) && $result['ok'] === true) {
            Log::info('✅ Telegram Notification Sent Successfully', [
                'chat_id' => $chatId,
                'message_preview' => substr(strip_tags($message), 0, 100) . '...'
            ]);
            return true;
        } else {
            Log::error('❌ Telegram API Error', [
                'error_code' => $result['error_code'] ?? null,
                'description' => $result['description'] ?? null,
                'http_code' => $httpCode,
                'message' => $message,
                'chat_id' => $chatId,
            ]);
            return false;
        }
    }
}
