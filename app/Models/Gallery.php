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
        'tag' => 'string', // Pastikan tag disimpan sebagai string
    ];

    /**
     * Get the gallery's title.
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getTagArrayAttribute()
    {
        if (empty($this->tag)) {
            return [];
        }

        // Jika tag disimpan sebagai string dipisahkan koma
        return array_filter(array_map('trim', explode(',', $this->tag)));
    }
}
