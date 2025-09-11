<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Destination;
use App\Models\Profile;

class UserDestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::orderBy('created_at')->get();
        $profiles = Profile::find(1) ?? Profile::first();
        return view('Client.destinationPage', compact('destinations', 'profiles'));
    }
}
