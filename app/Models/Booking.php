<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country',
        'travel_date',
        'message',
        'destination_name',
    ];

    public $timestamps = true;

    // Define any relationships or additional methods here
}
