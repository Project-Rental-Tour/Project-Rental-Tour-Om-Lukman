<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'blogs';

    protected $primaryKey = 'blog_id';
    public $incrementing = true;

    protected $fillable = [
        'title',
        'slug',
        'image_path',
        'content',
        'category',
        'time_read'
    ];

    public $timestamps = true;

    // Define any relationships or additional methods here
}
