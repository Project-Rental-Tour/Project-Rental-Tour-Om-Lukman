<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery; // Pastikan Model Gallery di-import

class Destination extends Model
{
    protected $table = 'destinations';

    protected $primaryKey = 'destination_id';

    protected $fillable = [
        'name_package',
        'slug',
        'description',
        'type_destination',
        'place',
        'price',
        'price_tiers',
        'discount_price',
        'price_2', 
        'destination_photo',
        'destination_photo_2',
        'destination_photo_3',
        'destination_photo_4',
        'time',
        'category',
        'level',
        'pickup_points',
        'dropoff_points',
        'activities',
        'transportation',
        'accommodation',
        'consumption',
        'include',
        'exclude',
        'wna_wni_policy',
        'itinerary',
        'tag',
        'note',
    ];

    protected $casts = [
        'pickup_points' => 'string',
        'dropoff_points' => 'string',
        'tag' => 'string',
        'price' => 'integer',
        'price_2' => 'integer',
        'price_tiers' => 'array', // <--- PENTING: Casting JSON ke Array otomatis
    ];

    public $timestamps = true;

    /**
     * Mengambil galeri terkait berdasarkan tags (Optimized).
     */
    public function relatedGalleries()
    {
        $tags = $this->tag;

        if (empty($tags) || !is_string($tags)) {
            return collect();
        }

        $tagArray = array_filter(array_map('trim', explode(',', $tags)));
        
        if (empty($tagArray)) {
            return collect();
        }

        // Regex pattern untuk pencarian sekaligus
        $regexPattern = '\\b(' . implode('|', array_map(function($tag) {
            return preg_quote(strtolower($tag), '/');
        }, $tagArray)) . ')\\b';

        return Gallery::whereRaw('LOWER(tag) REGEXP ?', [$regexPattern])
            ->limit(9)
            ->get();
    }
}