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
        'place',
        'price',
        'destination_photo',
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
        'itinerary',
        'tag',
        'note',
    ];

    protected $casts = [
        'pickup_points' => 'string',
        'dropoff_points' => 'string',
        'tag' => 'string', // Pastikan tag disimpan sebagai string
    ];

    public function relatedGalleries()
    {
        $tags = $this->tag;
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
                ->limit(3)
                ->get();

            $related = $related->merge($galleries);

            // kalau sudah 9, berhenti biar tidak kebanyakan
            if ($related->count() >= 9) {
                break;
            }
        }


        return $related->unique('gallery_id')->values();
    }


    public $timestamps = true;
}
