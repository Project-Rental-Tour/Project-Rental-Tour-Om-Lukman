<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationHelper
{
    public static function translate($text)
    {
        // 1. Cek Bahasa Target User
        $targetLang = Session::get('app_locale', 'id'); 

        // 2. Cek apakah teks kosong? Kalau kosong return string kosong
        if (empty($text)) {
            return '';
        }

        // HAPUS BAGIAN INI:
        // if ($targetLang == 'id') { return $text; }
        // Kita hapus agar jika input Inggris -> target Indo, dia tetap jalan.

        // 3. Cek CACHE
        // Kunci cache unik berdasarkan teks asli DAN bahasa target
        $cacheKey = 'trans_' . md5($text) . '_' . $targetLang;

        return Cache::rememberForever($cacheKey, function () use ($text, $targetLang) {
            try {
                $tr = new GoogleTranslate();
                
                // PERBAIKAN PENTING:
                // Set Source ke NULL agar Google otomatis mendeteksi bahasa input.
                // Jadi: Input Inggris -> Terdeteksi EN -> Translate ke ID
                $tr->setSource(null); 
                
                $tr->setTarget($targetLang);
                
                $result = $tr->translate($text);

                // Validasi: jika hasil kosong, kembalikan teks asli
                return !empty($result) ? $result : $text;

            } catch (\Exception $e) {
                // Jika Google Error/Limit, kembalikan teks asli saja
                return $text;
            }
        });
    }
}