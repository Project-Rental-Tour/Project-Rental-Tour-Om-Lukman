<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Destination;

class DestinationController extends Controller
{
    /**
     * Display a listing of destinations.
     */
    public function index()
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')
                ->with('toast', ['type' => 'error', 'message' => 'You need to login first']);
        }

        $destinations = Destination::paginate(25);
        return view('admin.manageDestination', compact('destinations'));
    }

    public function detailDestination() {}

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')
                ->with('toast', ['type' => 'error', 'message' => 'Unauthorized access']);
        }

        $request->validate([
            'name_package' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:destinations,slug',
            'place' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'destination_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'time' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'level' => 'nullable|string|max:50',
            'pickup_points' => 'nullable|string|max:500',
            'dropoff_points' => 'nullable|string|max:500',
            'activities' => 'nullable|string|max:500',
            'transportation' => 'nullable|string|max:255',
            'accommodation' => 'nullable|string|max:255',
            'consumption' => 'nullable|string|max:500',
            'include' => 'nullable|string',
            'exclude' => 'nullable|string',
            'itinerary' => 'nullable|string',
        ]);

        try {
            // Upload image
            $imagePath = $request->file('destination_photo')->store('public/destinations');
            $photoUrl = str_replace('public/', 'storage/', $imagePath);

            // Parse price (handle Indonesian format: 1.500.000 → 1500000)
            $price = $request->price !== null ? (float) str_replace(['.', ','], '', $request->price) : 0.00;

            // Generate slug if not provided
            $slug = $request->slug ?? Str::slug($request->name_package);
            $slugCount = Destination::where('slug', 'like', $slug . '%')->count();
            if ($slugCount > 0) {
                $slug = $slug . '-' . ($slugCount + 1);
            }

            Destination::create([
                'name_package' => $request->name_package,
                'slug' => $slug,
                'place' => $request->place,
                'price' => $price,
                'destination_photo' => $photoUrl,
                'time' => $request->time,
                'category' => $request->category,
                'level' => $request->level,
                'pickup_points' => $request->pickup_points ? json_encode(explode(',', $request->pickup_points)) : null,
                'dropoff_points' => $request->dropoff_points ? json_encode(explode(',', $request->dropoff_points)) : null,
                'activities' => $request->activities,
                'transportation' => $request->transportation,
                'accommodation' => $request->accommodation,
                'consumption' => $request->consumption,
                'include' => $request->include,
                'exclude' => $request->exclude,
                'itinerary' => $request->itinerary,
            ]);

            return redirect()->route('manage-destination.index')
                ->with('toast', ['type' => 'success', 'message' => 'Destination added successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to add destination: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified destination.
     */
    public function update(Request $request, $destination_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')
                ->with('toast', ['type' => 'error', 'message' => 'Unauthorized access']);
        }

        $request->validate([
            'name_package' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:destinations,slug,' . $destination_id . ',destination_id',
            'place' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'destination_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'time' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'level' => 'nullable|string|max:50',
            'pickup_points' => 'nullable|string|max:500',
            'dropoff_points' => 'nullable|string|max:500',
            'activities' => 'nullable|string|max:500',
            'transportation' => 'nullable|string|max:255',
            'accommodation' => 'nullable|string|max:255',
            'consumption' => 'nullable|string|max:500',
            'include' => 'nullable|string',
            'exclude' => 'nullable|string',
            'itinerary' => 'nullable|string',
        ]);

        try {
            $destination = Destination::findOrFail($destination_id);

            $price = $request->price !== null ? (float) str_replace(['.', ','], '', $request->price) : $destination->price;

            $updateData = [
                'name_package' => $request->name_package,
                'slug' => $request->slug ?? Str::slug($request->name_package),
                'place' => $request->place,
                'price' => $price,
                'time' => $request->time,
                'category' => $request->category,
                'level' => $request->level,
                'pickup_points' => $request->pickup_points ? json_encode(explode(',', $request->pickup_points)) : null,
                'dropoff_points' => $request->dropoff_points ? json_encode(explode(',', $request->dropoff_points)) : null,
                'activities' => $request->activities,
                'transportation' => $request->transportation,
                'accommodation' => $request->accommodation,
                'consumption' => $request->consumption,
                'include' => $request->include,
                'exclude' => $request->exclude,
                'itinerary' => $request->itinerary,
            ];

            // Handle photo upload
            if ($request->hasFile('destination_photo')) {
                // Delete old photo
                if ($destination->destination_photo) {
                    $oldPath = str_replace('storage/', 'public/', $destination->destination_photo);
                    if (Storage::exists($oldPath)) {
                        Storage::delete($oldPath);
                    }
                }

                // Store new photo
                $imagePath = $request->file('destination_photo')->store('public/destinations');
                $updateData['destination_photo'] = str_replace('public/', 'storage/', $imagePath);
            }

            // Ensure slug is unique
            $slug = $updateData['slug'];
            $slugCount = Destination::where('slug', $slug)
                ->where('destination_id', '!=', $destination_id)
                ->count();
            if ($slugCount > 0) {
                $updateData['slug'] = $slug . '-' . uniqid();
            }

            $destination->update($updateData);

            return redirect()->route('manage-destination.index')
                ->with('toast', ['type' => 'success', 'message' => 'Destination updated successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to update destination: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified destination.
     */
    public function destroy($destination_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')
                ->with('toast', ['type' => 'error', 'message' => 'Unauthorized access']);
        }

        try {
            $destination = Destination::findOrFail($destination_id);

            // Delete photo
            if ($destination->destination_photo) {
                $path = str_replace('storage/', 'public/', $destination->destination_photo);
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
            }

            $destination->delete();

            return redirect()->route('manage-destination.index')
                ->with('toast', ['type' => 'success', 'message' => 'Destination deleted successfully']);
        } catch (\Exception $e) {
            return back()->with('toast', ['type' => 'error', 'message' => 'Failed to delete destination: ' . $e->getMessage()]);
        }
    }

    /**
     * Bulk delete destinations.
     */
    public function bulkDestroy(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return response()->json([
                'success' => false,
                'toast' => ['type' => 'error', 'message' => 'Unauthorized access']
            ], 401);
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:destinations,destination_id',
        ]);

        try {
            $destinations = Destination::whereIn('destination_id', $request->ids)->get();

            foreach ($destinations as $destination) {
                if ($destination->destination_photo) {
                    $path = str_replace('storage/', 'public/', $destination->destination_photo);
                    if (Storage::exists($path)) {
                        Storage::delete($path);
                    }
                }
                $destination->delete();
            }

            return response()->json([
                'success' => true,
                'toast' => ['type' => 'success', 'message' => 'Selected destinations deleted successfully']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'toast' => ['type' => 'error', 'message' => 'Failed to bulk delete destinations: ' . $e->getMessage()]
            ], 500);
        }
    }
}
