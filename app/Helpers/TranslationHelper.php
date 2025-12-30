<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationHelper
{
    public static function translate($text)
    {
        // 1. Cek Bahasa Target User (Diset oleh Middleware IP tadi)
        $targetLang = Session::get('app_locale', 'id'); // Default ID

        // 2. Jika user orang Indo atau Text kosong, langsung tampilkan aslinya
        if ($targetLang == 'id' || empty($text)) {
            return $text;
        }

        // 3. Cek CACHE (Biar gak lemot & gak kena limit Google)
        // Kita buat kunci unik berdasarkan teks dan bahasa target
        $cacheKey = 'trans_' . md5($text) . '_' . $targetLang;

        return Cache::rememberForever($cacheKey, function () use ($text, $targetLang) {
            try {
                // 4. Minta Google Terjemahkan
                $tr = new GoogleTranslate();
                $tr->setSource('id'); // Asumsi database Anda bahasa Indonesia
                $tr->setTarget($targetLang);
                
                return $tr->translate($text);
            } catch (\Exception $e) {
                // Jika Google Error/Limit, kembalikan teks asli saja
                return $text;
            }
        });
    }
}