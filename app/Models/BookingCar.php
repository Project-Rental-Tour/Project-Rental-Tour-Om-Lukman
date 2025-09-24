<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCar extends Model
{
    protected $table = 'booking_cars';

    protected $primaryKey = 'booking_cars_id';

    public $timestamps = true;

    protected $fillable = [
        'car_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'start_date',
        'end_date',
        'total_price',
        'rental_type',
        'booking_status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'rental_type' => 'boolean',
        'total_price' => 'decimal:2',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }
}
