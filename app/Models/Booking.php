<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'destination_id',
        'destination_name',
        'travel_date',
        'duration_nights',
        'package_type',
        'first_name',
        'last_name',
        'email',
        'country',
        'phone_number',
        'message',
        'custom_destinations',
        'interests',
        'travelers',
        'budget_range',
    ];

    protected $casts = [
        'interests' => 'json',
    ];

    public $timestamps = true;

    // Define any relationships or additional methods here
}
