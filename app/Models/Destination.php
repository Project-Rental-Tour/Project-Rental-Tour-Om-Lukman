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
    ];

    protected $casts = [
        'pickup_points' => 'array',
        'dropoff_points' => 'array',
    ];

    public $timestamps = true;
}
