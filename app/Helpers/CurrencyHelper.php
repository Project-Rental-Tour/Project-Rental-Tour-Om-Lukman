<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyHelper
{
    public static function convert($amountInIdr)
    {
        // 1. Ambil mata uang target dari session (default IDR)
        $targetCurrency = Session::get('app_currency', 'IDR');

        // Jika IDR, langsung return format Rupiah
        if ($targetCurrency === 'IDR') {
            return 'Rp ' . number_format($amountInIdr, 0, ',', '.');
        }

        // 2. Ambil Rate Konversi (Real-time dengan Caching)
        // Kita cache selama 12 jam (43200 detik) agar tidak request API terus menerus
        $rates = Cache::remember('exchange_rates_base_idr', 43200, function () {
            try {
                // GUNAKAN API GRATIS (Contoh: exchangerate-api.com)
                // Ganti URL ini jika Anda punya API Key sendiri
                // API ini mengambil Base IDR ke semua mata uang
                $response = Http::get('https://api.exchangerate-api.com/v4/latest/IDR');
                
                if ($response->successful()) {
                    return $response->json()['rates'];
                }
            } catch (\Exception $e) {
                // Jika error (koneksi putus), return null
                return null;
            }
            return null;
        });

        // 3. Fallback Manual (Jaga-jaga jika API mati/error)
        // Nilai perkiraan kasar jika API gagal
        if (!$rates) {
            $rates = [
                'USD' => 0.000064, 'SGD' => 0.000086, 'MYR' => 0.00030,
                'JPY' => 0.0096,   'AUD' => 0.000098, 'GBP' => 0.000051,
                'EUR' => 0.000059
            ];
        }

        // 4. Hitung Konversi
        $rate = $rates[$targetCurrency] ?? 0;
        
        // Jika mata uang tidak ada di list API, balik ke USD
        if ($rate == 0) {
            $targetCurrency = 'USD';
            $rate = $rates['USD'];
        }

        $convertedAmount = $amountInIdr * $rate;

        // 5. Format Output (Mata Uang Asing biasanya 2 desimal)
        return $targetCurrency . ' ' . number_format($convertedAmount, 2);
    }
}