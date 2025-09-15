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
    ];

    protected $casts = [
        'pickup_points' => 'array',
        'dropoff_points' => 'array',
        'tag' => 'array',
    ];

    public function relatedGalleries()
    {
        $tags = $this->tag; // JSON array dari DB

        if (empty($tags)) {
            return collect(); // kembalikan koleksi kosong jika tidak ada tag
        }

        return Gallery::where(function ($query) use ($tags) {
            foreach ($tags as $tag) {
                $query->orWhereRaw('JSON_CONTAINS(tag, ?)', ['"' . $tag . '"']);
            }
        })->orWhereIn('tag', $tags) // untuk yang tag-nya string biasa (opsional)
            ->limit(4)
            ->get();
    }

    public $timestamps = true;
}
