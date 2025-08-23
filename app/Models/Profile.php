<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'website_name',
        'website_logo',
        'jumbotron_heading',
        'jumbotron_subheading',
        'jumbotron_image',
        'about_heading',
        'about_description',
        'address',
        'contact_email',
        'phone_number',
        'facebook_link',
        'instagram_link',
        'operating_hours',
    ];

    public $timestamps = true;

    // Define any relationships or additional methods here
}
