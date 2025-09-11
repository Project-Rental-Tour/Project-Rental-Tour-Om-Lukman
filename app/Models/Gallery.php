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

    /**
     * Get the gallery's title.
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }
}
