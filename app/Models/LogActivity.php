<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $table = 'log_activities';

    protected $primaryKey = 'log_activity_id';

    protected $fillable = [
        'username',
        'action',
    ];

    public $timestamps = true;
}
