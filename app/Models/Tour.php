<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tours';

    protected $primaryKey = 'tour_id';

    protected $fillable = [
        'name_section',
        'image_section',
        'title',
        'description',
        'tag',
    ];

    public $timestamps = true;
}
