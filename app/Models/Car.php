<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';

    protected $primaryKey = 'car_id';

    public $timestamps = true;

    /**
     * Kolom yang bisa diisi secara massal.
     */
    protected $fillable = [
        'name_car',
        'slug',
        'image_car_1',
        'image_car_2',
        'image_car_3',
        'description',
        'car_type',
        'price',
        'capacity',
        'transmission',
        'car_status',
        'rental_type',
        'include',
        'additional',
        'notes'
    ];

    /**
     * Casting tipe data otomatis.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'rental_type' => 'boolean', // Penting! agar selalu jadi true/false
        'quantity' => 'integer',
        'capacity' => 'integer',
    ];

    /**
     * Accessor: Tampilkan tipe rental dalam bentuk teks.
     */
}
