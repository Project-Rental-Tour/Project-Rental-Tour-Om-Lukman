<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Profile;

class UserCarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::where('car_status', 'available');
        $profiles = Profile::find(1) ?? Profile::first();

        // Filter by car type
        if ($request->filled('type')) {
            $query->where('car_type', $request->type);
        }

        // Filter by transmission
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Filter by capacity
        if ($request->filled('capacity')) {
            $capacity = (int) $request->capacity;
            if ($capacity == 8) {
                $query->where('capacity', '>=', 8);
            } else {
                $query->where('capacity', $capacity);
            }
        }

        // Filter by price range
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case 'low':
                    $query->where('price', '<', 500000);
                    break;
                case 'medium':
                    $query->whereBetween('price', [500000, 1000000]);
                    break;
                case 'high':
                    $query->where('price', '>', 1000000);
                    break;
            }
        }

        // Get unique car types for filter sidebar
        $carTypes = Car::whereNotNull('car_type')
            ->where('car_type', '!=', '')
            ->distinct()
            ->pluck('car_type')
            ->filter()
            ->values();

        // Order by newest first
        $cars = $query->paginate(25)->appends($request->except('page'));


        return view('Client.listCarPage', compact('cars', 'carTypes', 'profiles'));
    }

    public function detailCar($slug)
    {
        $profiles = Profile::find(1) ?? Profile::first();
        $car = Car::where('slug', $slug)->firstOrFail();
        return view('Client.detailCarPage', compact('car', 'profiles'));
    }
}
