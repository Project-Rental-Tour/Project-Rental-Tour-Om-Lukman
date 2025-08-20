<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = 'blog_posts';

    protected $primaryKey = 'blog_post_id';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
    ];

    public $timestamps = true;

    /**
     * Get the blog post's title.
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }
}
