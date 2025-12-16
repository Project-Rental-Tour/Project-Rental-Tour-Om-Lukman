<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'discount_price',
        'price_2', // Kolom harga baru
        'destination_photo',
        'destination_photo_2', // Foto baru
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
        'wna_wni_policy', // Kolom kebijakan WNA/WNI
        'itinerary',
        'tag',
        'note',
    ];

    protected $casts = [
        'pickup_points' => 'string',
        'dropoff_points' => 'string',
        'tag' => 'string',
    ];

    public function relatedGalleries()
    {
        $tags = $this->tag;
        
        // Asumsi: Model Gallery sudah di-import atau berada di namespace yang sama
        // Pastikan Anda mengimport Model Gallery jika berada di namespace yang berbeda: use App\Models\Gallery; 

        if (!$tags || !is_string($tags)) {
            return collect();
        }

        $tagArray = array_filter(array_map('trim', explode(',', $tags)));
        $tagArray = array_map('strtolower', $tagArray);

        if (empty($tagArray)) {
            return collect();
        }

        $related = collect();

        foreach ($tagArray as $tag) {
            $pattern = '\\b' . preg_quote($tag, '/') . '\\b';

            $galleries = Gallery::whereRaw('LOWER(tag) REGEXP ?', [$pattern])
                ->limit(4)
                ->get();

            $related = $related->merge($galleries);

            if ($related->count() >= 9) {
                break;
            }
        }

        return $related->unique('gallery_id')->take(9)->values();
    }

    public $timestamps = true;
}