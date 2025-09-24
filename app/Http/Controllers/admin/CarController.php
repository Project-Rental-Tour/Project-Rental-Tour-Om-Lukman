<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Car;
use App\Models\LogActivity;
use App\Models\Profile;

class CarController extends Controller
{
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

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        // Generate slug otomatis dari nama mobil
        $nameCar = $request->input('name_car');
        $baseSlug = Str::slug($nameCar, '-');
        $slug = $baseSlug;
        $counter = 1;

        // Pastikan slug unik
        while (Car::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Validasi semua field
        $validated = $request->validate([
            'name_car' => 'required|string|max:255',
            'image_car_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_car_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_car_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        // Tambahkan slug yang sudah digenerate
        $validated['slug'] = $slug;

        try {
            // Handle image uploads
            $image1Path = $request->file('image_car_1')->store('public/cars');
            $imagePaths = [
                'image_car_1' => str_replace('public/', 'storage/', $image1Path),
                'image_car_2' => null,
                'image_car_3' => null,
            ];

            if ($request->hasFile('image_car_2')) {
                $image2Path = $request->file('image_car_2')->store('public/cars');
                $imagePaths['image_car_2'] = str_replace('public/', 'storage/', $image2Path);
            }

            if ($request->hasFile('image_car_3')) {
                $image3Path = $request->file('image_car_3')->store('public/cars');
                $imagePaths['image_car_3'] = str_replace('public/', 'storage/', $image3Path);
            }

            // Gabungkan semua data
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

    public function update(Request $request, $car_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $car = Car::findOrFail($car_id);

        // Generate slug otomatis dari nama mobil
        $nameCar = $request->input('name_car');
        $baseSlug = Str::slug($nameCar, '-');
        $slug = $baseSlug;
        $counter = 1;

        // Pastikan slug unik (kecuali untuk mobil ini sendiri)
        while (Car::where('slug', $slug)->where('car_id', '!=', $car_id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Validasi semua field
        $validated = $request->validate([
            'name_car' => 'required|string|max:255',
            'image_car_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_car_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_car_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        // Tambahkan slug yang sudah digenerate
        $validated['slug'] = $slug;

        try {
            $updateData = $validated;

            // Handle image updates
            foreach (['image_car_1', 'image_car_2', 'image_car_3'] as $imageField) {
                if ($request->hasFile($imageField)) {
                    // Delete old image if exists
                    if ($car->{$imageField}) {
                        Storage::delete(str_replace('storage/', 'public/', $car->{$imageField}));
                    }

                    $imagePath = $request->file($imageField)->store('public/cars');
                    $updateData[$imageField] = str_replace('public/', 'storage/', $imagePath);
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
