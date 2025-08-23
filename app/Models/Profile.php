<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'website_name',
        'website_logo_light',
        'website_logo_dark',
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
