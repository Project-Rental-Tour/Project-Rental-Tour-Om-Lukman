<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Models\Car;
use App\Models\LogActivity;
use App\Models\Profile;

class CarController extends Controller
{
    /**
     * Display a listing of cars.
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $query = Car::query();

        $profiles = Profile::find(1) ?? Profile::first();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name_car', 'like', "%{$search}%")
                ->orWhere('car_type', 'like', "%{$search}%")
                ->orWhere('transmission', 'like', "%{$search}%");
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name-asc':
                $query->orderBy('name_car', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name_car', 'desc');
                break;
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $notifications = LogActivity::where('action', 'like', '%Submitted custom trip request%')
            ->orWhere('action', 'like', '%Submitted regular booking%')
            ->latest()
            ->take(10)
            ->get();

        LogActivity::create([
            'username' => $currentUser->username,
            'action' => 'Viewed Car list (filtered: ' . ($request->filled('search') ? 'yes' : 'no') . ')'
        ]);

        $cars = $query->paginate(25)->appends($request->except('page'));
        return view('Admin.manageCar', compact('cars', 'notifications', 'profiles'));
    }

    /**
     * Helper function to compress and store image
     */
    private function processImage($file, $path = 'public/cars', $quality = 75)
    {
        // Create new image manager instance with GD driver
        $manager = new ImageManager(new Driver());

        // Read image from file
        $image = $manager->read($file);

        // Optional: Resize image if it's too large (e.g., max width 1920px)
        if ($image->width() > 1920) {
            $image->scale(width: 1920);
        }

        // Encode image to JPEG with reduced quality
        $encoded = $image->toJpeg($quality);

        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.jpg';
        $fullPath = $path . '/' . $filename;

        // Store image using Laravel Storage
        Storage::put($fullPath, (string) $encoded);

        // Return the path for database storage (replace public/ with storage/)
        return str_replace('public/', 'storage/', $fullPath);
    }

    /**
     * Store a newly created car.
     */
    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        // Generate slug automatically
        $nameCar = $request->input('name_car');
        $baseSlug = Str::slug($nameCar, '-');
        $slug = $baseSlug;
        $counter = 1;

        while (Car::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Validation
        $validated = $request->validate([
            'name_car' => 'required|string|max:255',
            'image_car_1' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Increased limit to 5MB
            'image_car_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_car_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'required|string',
            'car_type' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'transmission' => 'required|string|in:manual,automatic',
            'car_status' => 'nullable|string|in:available,booked,maintenance',
            'rental_type' => 'nullable|boolean',
            'include' => 'nullable|string',
            'additional' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $validated['slug'] = $slug;

        try {
            // Handle image uploads with compression
            $imagePaths = [
                'image_car_1' => null,
                'image_car_2' => null,
                'image_car_3' => null,
            ];

            // Image 1 (Required)
            if ($request->hasFile('image_car_1')) {
                $imagePaths['image_car_1'] = $this->processImage($request->file('image_car_1'));
            }

            // Image 2 (Optional)
            if ($request->hasFile('image_car_2')) {
                $imagePaths['image_car_2'] = $this->processImage($request->file('image_car_2'));
            }

            // Image 3 (Optional)
            if ($request->hasFile('image_car_3')) {
                $imagePaths['image_car_3'] = $this->processImage($request->file('image_car_3'));
            }

            // Merge data
            $carData = array_merge($validated, $imagePaths);

            $car = Car::create($carData);

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Added car: "' . $car->name_car . '" (ID: ' . $car->car_id . ') with price Rp' . number_format($car->price, 0, ',', '.') . '/day',
            ]);

            return redirect()->route('manage-car.index')
                ->with('toast', ['type' => 'success', 'message' => 'Car added successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to add car: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified car.
     */
    public function update(Request $request, $car_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $car = Car::findOrFail($car_id);

        // Generate slug automatically
        $nameCar = $request->input('name_car');
        $baseSlug = Str::slug($nameCar, '-');
        $slug = $baseSlug;
        $counter = 1;

        while (Car::where('slug', $slug)->where('car_id', '!=', $car_id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Validation
        $validated = $request->validate([
            'name_car' => 'required|string|max:255',
            'image_car_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Increased limit to 5MB
            'image_car_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_car_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'description' => 'required|string',
            'car_type' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'transmission' => 'required|string|in:manual,automatic',
            'car_status' => 'nullable|string|in:available,booked,maintenance',
            'rental_type' => 'nullable|boolean',
            'include' => 'nullable|string',
            'additional' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $validated['slug'] = $slug;

        try {
            $updateData = $validated;

            // Handle image updates with compression
            foreach (['image_car_1', 'image_car_2', 'image_car_3'] as $imageField) {
                if ($request->hasFile($imageField)) {
                    // Delete old image if exists
                    if ($car->{$imageField}) {
                        Storage::delete(str_replace('storage/', 'public/', $car->{$imageField}));
                    }

                    // Compress and store new image
                    $updateData[$imageField] = $this->processImage($request->file($imageField));
                }
            }

            $oldName = $car->name_car;
            $oldPrice = $car->price;
            $car->update($updateData);

            $logAction = "Updated car: '{$oldName}' → '{$car->name_car}' (Price: Rp" . number_format($oldPrice, 0, ',', '.') . " → Rp" . number_format($car->price, 0, ',', '.') . ")";

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => $logAction,
            ]);

            return redirect()->route('manage-car.index')
                ->with('toast', ['type' => 'success', 'message' => 'Car updated successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Update failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified car.
     */
    public function destroy($car_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        try {
            $car = Car::findOrFail($car_id);
            $deletedName = $car->name_car;

            // Delete images
            foreach (['image_car_1', 'image_car_2', 'image_car_3'] as $imageField) {
                if ($car->{$imageField}) {
                    Storage::delete(str_replace('storage/', 'public/', $car->{$imageField}));
                }
            }

            $car->delete();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Deleted car: "' . $deletedName . '" (ID: ' . $car_id . ')',
            ]);

            return redirect()->route('manage-car.index')
                ->with('toast', ['type' => 'success', 'message' => 'Car deleted successfully']);
        } catch (\Exception $e) {
            return back()->with('toast', ['type' => 'error', 'message' => 'Delete failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Bulk delete cars.
     */
    public function bulkDestroy(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', [
                'type' => 'error',
                'message' => 'You do not have permission to view this page.'
            ]);
        }

        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:cars,car_id',
        ]);

        try {
            $cars = Car::whereIn('car_id', $validated['ids'])->get();

            if ($cars->isEmpty()) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'No cars selected.'
                ]);
            }

            $deletedNames = $cars->pluck('name_car');
            $count = $cars->count();

            foreach ($cars as $car) {
                // Delete images
                foreach (['image_car_1', 'image_car_2', 'image_car_3'] as $imageField) {
                    if ($car->{$imageField}) {
                        Storage::delete(str_replace('storage/', 'public/', $car->{$imageField}));
                    }
                }
                $car->delete();
            }

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Bulk deleted {$count} car(s): " . $deletedNames->join(', '),
            ]);

            if (!$request->expectsJson()) {
                return redirect()->route('manage-car.index')->with('toast', [
                    'type' => 'success',
                    'message' => "{$count} car(s) deleted successfully."
                ]);
            }

            return response()->json([
                'success' => true,
                'toast' => [
                    'type' => 'success',
                    'message' => "{$count} car(s) deleted successfully."
                ]
            ]);
        } catch (\Exception $e) {
            if (!$request->expectsJson()) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'Bulk delete failed: ' . $e->getMessage()
                ]);
            }

            return response()->json([
                'success' => false,
                'toast' => [
                    'type' => 'error',
                    'message' => 'Bulk delete failed: ' . $e->getMessage()
                ]
            ], 500);
        }
    }
}