<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'logo_photo',
        'name_company',
        'description',
    ];

    public $timestamps = true;

    // Define any relationships or additional methods here
}
