<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\type;

class Tour extends Model
{
    protected $table = 'tours';

    protected $primaryKey = 'tour_id';

    protected $fillable = [
        'name_section',
        'image_section',
        'title',
        'description',
        'type',
        'tag',
    ];

    public $timestamps = true;
}
