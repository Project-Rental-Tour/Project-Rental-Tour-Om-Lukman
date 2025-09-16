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
        'pickup_points' => 'array',
        'dropoff_points' => 'array',
        'tag' => 'array',
    ];

    public function relatedGalleries()
    {
        $tags = $this->tag;

        // Normalisasi tags menjadi array
        if (!is_array($tags)) {
            $decoded = json_decode($tags, true);
            if (is_array($decoded)) {
                $tags = $decoded;
            } else {
                $tags = $tags ? array_map('trim', explode(',', $tags)) : [];
            }
        }

        $tags = array_filter(array_map('trim', (array) $tags));
        if (empty($tags)) {
            return collect();
        }

        return Gallery::where(function ($query) use ($tags) {
            foreach ($tags as $tag) {
                if (empty($tag)) continue;

                // Gunakan JSON_SEARCH untuk mencari nilai di dalam objek
                $query->orWhereRaw("
                JSON_SEARCH(tag, 'one', ?) IS NOT NULL
            ", [$tag]);
            }
        })
            ->limit(4)
            ->get();
    }

    public $timestamps = true;
}
