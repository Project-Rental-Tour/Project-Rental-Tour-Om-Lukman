<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class LocalizeApp
{
    public function handle(Request $request, Closure $next)
    {
        // Hanya jalankan jika session belum di-set (agar hemat resource)
        if (!session()->has('app_currency')) {
            
            // 1. Ambil IP Address
            // Di Localhost, $ip akan '127.0.0.1', jadi kita perlu mock untuk testing
            $ip = $request->ip();
            if (app()->isLocal()) {
                $ip = '103.217.129.1'; // Contoh IP Indonesia (Indihome)
                // $ip = '103.217.129.1';   // INDONESIA (Telkom) -> Harusnya IDR / Bahasa ID
                // $ip = '128.101.101.101'; // USA (University of Minnesota) -> Harusnya USD / Bahasa EN
                // $ip = '118.200.0.0';     // SINGAPORE (Singtel) -> Harusnya SGD / Bahasa EN
                // $ip = '60.48.0.0';       // MALAYSIA (TM Net) -> Harusnya MYR / Bahasa EN
                // $ip = '101.140.0.0';     // JEPANG (Biglobe) -> Harusnya JPY / Bahasa EN
                // $ip = '1.0.0.0';         // AUSTRALIA (Cloudflare APNIC) -> Harusnya AUD / Bahasa EN
                // $ip = '81.2.69.1';       // UK (British Telecom) -> Harusnya GBP / Bahasa EN
                // $ip = '80.128.0.0';      // JERMAN/EROPA (Deutsche Telekom) -> Harusnya EUR / Bahasa EN
            }

            // 2. Deteksi Lokasi
            $position = Location::get($ip);
            $countryCode = $position ? $position->countryCode : 'US';

            // 3. Logic Penentuan (Indo vs The World)
            $this->setLocaleAndCurrency($countryCode);
        }

        // 4. Terapkan Locale ke Aplikasi Laravel
        app()->setLocale(session('app_locale'));

        return $next($request);
    }

    private function setLocaleAndCurrency($countryCode)
    {
        // Default (Fallback) -> English & USD
        $locale = 'en';
        $currency = 'USD';

        switch ($countryCode) {
            case 'ID': // Indonesia
                $locale = 'id';
                $currency = 'IDR';
                break;
            
            // --- NEGARA LAIN (Bahasa Inggris, Mata Uang Lokal) ---
            case 'SG': // Singapore
                $locale = 'en'; 
                $currency = 'SGD';
                break;
            
            case 'MY': // Malaysia
                $locale = 'en';
                $currency = 'MYR';
                break;

            case 'JP': // Jepang
                $locale = 'en';
                $currency = 'JPY';
                break;

            case 'AU': // Australia
                $locale = 'en';
                $currency = 'AUD';
                break;

            case 'GB': // United Kingdom
                $locale = 'en';
                $currency = 'GBP';
                break;
                
            case 'DE': // Jerman (Euro)
            case 'FR': // Perancis (Euro)
            case 'ES': // Spanyol (Euro)
            case 'NL': // Belanda (Euro)
                $locale = 'en';
                $currency = 'EUR';
                break;

            // Tambahkan case lain sesuai kebutuhan...
            
            default:
                // US dan negara sisa lainnya masuk sini
                $locale = 'en';
                $currency = 'USD';
                break;
        }

        // Simpan ke Session
        session([
            'app_locale' => $locale,
            'app_currency' => $currency,
            'app_country' => $countryCode // Opsional, buat debug
        ]);
    }
}