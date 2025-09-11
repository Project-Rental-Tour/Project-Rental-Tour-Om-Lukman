<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        // Gunakan first() sebagai fallback jika find(1) tidak ada
        $profiles = Profile::find(1) ?? Profile::first();

        $latestGalleries = Gallery::orderBy('created_at', 'desc')->take(3)->get();


        return view('Client.homePage', compact('testimonials', 'galleries', 'destinations', 'profiles', 'latestGalleries'));
    }

    public function about()
    {
        $profiles = Profile::find(1) ?? Profile::first();
        return view('Client.aboutPage', compact('profiles'));
    }

    public function faq()
    {
        $profiles = Profile::find(1) ?? Profile::first();
        return view('Client.faqPage', compact('profiles'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'nullable|string|max:50',
            'subject'  => 'required|string|max:255',
            'company'  => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'message'  => 'required|string|max:2000',
        ]);

        // Siapkan pesan untuk Telegram (format HTML)
        $message = "<b>📩 New Contact Message</b>\n";
        $message .= "<b>👤 Name:</b> " . htmlspecialchars($validated['name']) . "\n";
        $message .= "<b>📧 Email:</b> " . htmlspecialchars($validated['email']) . "\n";
        $message .= "<b>📞 Phone:</b> " . htmlspecialchars($validated['phone'] ?? '—') . "\n";
        $message .= "<b>📌 Subject:</b> " . htmlspecialchars($validated['subject']) . "\n";
        $message .= "<b>🏢 Company:</b> " . htmlspecialchars($validated['company'] ?? '—') . "\n";
        $message .= "<b>📍 Location:</b> " . htmlspecialchars($validated['location'] ?? '—') . "\n";
        $message .= "<b>💬 Message:</b>\n" . htmlspecialchars($validated['message']) . "\n";
        $message .= "<b>📅 Received:</b> " . now()->format('d M Y H:i:s') . " WIB";

        // Kirim notifikasi ke Telegram
        $this->sendTelegramNotification($message);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function sendTelegramNotification($message)
    {
        $token = config('telegram.bot_token');
        $chatId = config('telegram.chat_id');

        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
        ];

        // Use curl instead of Http::post()
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_TIMEOUT => 15,
            CURLOPT_SSL_VERIFYPEER => false, // ⚠️ Hanya untuk debug / server tidak aman
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_USERAGENT => 'Laravel Booking System',
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

        if ($httpCode == 200 && $result['ok'] === true) {
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
