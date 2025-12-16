<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{

    protected $table = 'testimonials';

    public $incrementing = true;

    protected $primaryKey = 'testimonial_id';

    protected $fillable = [
        'name',
        'role',
        'location',
        'content',
        'rating',
        'image', // Kolom baru ditambahkan
    ];

    public $timestamps = true;

    // Define any relationships or additional methods here
}