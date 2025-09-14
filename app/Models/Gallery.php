<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $primaryKey = 'gallery_id';

    protected $fillable = [
        'title',
        'gallery_photo',
        'tag',
    ];

    public $timestamps = true;

    protected $casts = [
        'tag' => 'array',
    ];

    /**
     * Get the gallery's title.
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getTagAttribute($value)
    {
        $tags = json_decode($value, true);

        if (!is_array($tags)) {
            return [];
        }

        return collect($tags)
            ->map(function ($tag) {
                return is_array($tag) ? ($tag['value'] ?? null) : $tag;
            })
            ->filter()
            ->values()
            ->all();
    }
}
