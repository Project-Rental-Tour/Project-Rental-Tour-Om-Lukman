<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class LocalizeApp
{
    public function handle(Request $request, Closure $next)
    {
        // Cek session
        if (!session()->has('app_currency')) {
            
            // 1. Logika Pengambilan IP yang Valid untuk Prod & Dev
            $ip = $this->getClientIP($request);

            // 2. Deteksi Lokasi
            // Default ke US jika gagal detect
            $position = Location::get($ip);
            $countryCode = $position ? $position->countryCode : 'US';

            // 3. Set Locale
            $this->setLocaleAndCurrency($countryCode);
        }

        app()->setLocale(session('app_locale'));

        return $next($request);
    }

    // Fungsi Helper untuk ambil IP yang benar
    private function getClientIP(Request $request)
    {
        // A. Jika di Localhost / Laptop
        if (app()->isLocal()) {
            // Ganti-ganti ini manual saat coding untuk ngetes
            return '128.101.101.101'; // Contoh USA
            // return '103.217.129.1'; // Contoh Indo
        }

        // B. Jika di Production (Hosting/VPS)
        // Prioritaskan Cloudflare atau Proxy Header
        if ($request->server('HTTP_CF_CONNECTING_IP')) {
            return $request->server('HTTP_CF_CONNECTING_IP');
        }
        
        if ($request->server('HTTP_X_FORWARDED_FOR')) {
             // Kadang return list IP "client, proxy1, proxy2", ambil yang pertama
             $ips = explode(',', $request->server('HTTP_X_FORWARDED_FOR'));
             return trim($ips[0]);
        }

        return $request->ip();
    }

    private function setLocaleAndCurrency($countryCode)
    {
        // ... (Isi fungsi ini TETAP SAMA seperti kode Anda sebelumnya) ...
        $locale = 'en';
        $currency = 'USD';

        switch ($countryCode) {
            case 'ID': 
                $locale = 'id';
                $currency = 'IDR';
                break;
            // ... case lainnya ...
            default:
                $locale = 'en';
                $currency = 'USD';
                break;
        }

        session([
            'app_locale' => $locale,
            'app_currency' => $currency,
        ]);
    }
}