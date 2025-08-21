<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\type;

class Tour extends Model
{
    protected $table = 'tours';

    protected $primaryKey = 'tour_id';

    protected $fillable = [
        'title',
        'description',
        'type',
        'facility'
    ];

    public $timestamps = true;
}
