<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use App\Models\Destination;
use App\Models\LogActivity;
use App\Models\Profile;
use App\Models\Gallery;

class DestinationController extends Controller
{
    /**
     * Display a listing of destinations.
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $query = Destination::query();

        $profiles = Profile::find(1) ?? Profile::first();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name_package', 'like', "%{$search}%")
                ->orWhere('place', 'like', "%{$search}%")
                ->orWhere('price', 'like', "%{$search}%")
                ->orWhere('price_2', 'like', "%{$search}%") // Kolom baru
                ->orWhere('time', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('level', 'like', "%{$search}%")
                ->orWhere('activities', 'like', "%{$search}%");
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name-asc':
                $query->orderBy('name_package', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name_package', 'desc');
                break;
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
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
            'action' => 'Viewed Destination list (filtered: ' . ($request->filled('search') ? 'yes' : 'no') . ')'
        ]);

        $destinations = $query->paginate(25)->appends($request->except('page'));
        return view('Admin.manageDestination', compact('destinations', 'notifications', 'profiles'));
    }

    public function detailDestination($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        $profiles = Profile::find(1);

        Log::info('Destination Tag:', ['value' => $destination->tag]);
        Log::info('All Gallery Tags:', ['tags' => Gallery::pluck('tag')->toArray()]);

        $relatedGalleries = $destination->relatedGalleries();

        Log::info('Related Galleries Count:', [$relatedGalleries->count()]);

        return view('Client.detailDestination', compact('destination', 'profiles', 'relatedGalleries'));
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        Log::info('Request Data:', $request->all());
        Log::info('Tag Value:', ['tag' => $request->tag, 'type' => gettype($request->tag)]);

        // VALIDATION
        $request->validate([
            'name_package' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:destinations,slug',
            'description' => 'nullable|string',
            'place' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_2' => 'nullable|numeric|min:0', // Kolom baru
            'destination_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination_photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kolom baru
            'destination_photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kolom baru
            'destination_photo_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kolom baru
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
            'wna_wni_policy' => 'nullable|string', // Kolom baru
            'itinerary' => 'nullable|string',
            'tag' => 'nullable|string|max:500',
            'note' => 'nullable|string',
        ]);

        $photoUrls = [];

        try {
            // Upload images (Destination Photo 1, 2, 3, 4)
            $photoFields = ['destination_photo', 'destination_photo_2', 'destination_photo_3', 'destination_photo_4'];

            foreach ($photoFields as $index => $field) {
                if ($request->hasFile($field)) {
                    $imagePath = $request->file($field)->store('public/destinations');
                    $photoUrls[$field] = str_replace('public/', 'storage/', $imagePath);
                } else {
                    $photoUrls[$field] = null;
                }
            }

            // Parse prices
            $price = $request->price !== null ? (float) str_replace(['.', ','], '', $request->price) : 0.00;
            $price_2 = $request->price_2 !== null ? (float) str_replace(['.', ','], '', $request->price_2) : 0.00; // Kolom baru

            // Generate slug
            $slug = $request->slug ?? Str::slug($request->name_package);
            $originalSlug = $slug;
            $counter = 1;
            while (Destination::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $tagString = $request->tag ?: null;
            Log::info('Processed Tag:', ['tagString' => $tagString]);

            $destination = Destination::create([
                'name_package' => $request->name_package,
                'slug' => $slug,
                'description' => $request->description,
                'place' => $request->place,
                'price' => $price,
                'price_2' => $price_2, // Kolom baru
                'destination_photo' => $photoUrls['destination_photo'],
                'destination_photo_2' => $photoUrls['destination_photo_2'], // Kolom baru
                'destination_photo_3' => $photoUrls['destination_photo_3'], // Kolom baru
                'destination_photo_4' => $photoUrls['destination_photo_4'], // Kolom baru
                'time' => $request->time,
                'category' => $request->category,
                'level' => $request->level,
                'pickup_points' => $request->pickup_points,
                'dropoff_points' => $request->dropoff_points,
                'activities' => $request->activities,
                'transportation' => $request->transportation,
                'accommodation' => $request->accommodation,
                'consumption' => $request->consumption,
                'include' => $request->include,
                'exclude' => $request->exclude,
                'wna_wni_policy' => $request->wna_wni_policy, // Kolom baru
                'itinerary' => $request->itinerary,
                'tag' => $tagString,
                'note' => $request->note,
            ]);

            Log::info('Created Destination:', ['destination' => $destination->toArray()]);

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Added destination: "' . Str::limit($destination->name_package, 50) . '" in ' . $destination->place . ' with tags: ' . $tagString,
            ]);

            return redirect()->route('manage-destination.index')
                ->with('toast', ['type' => 'success', 'message' => 'Destination added successfully']);
        } catch (\Exception $e) {
            Log::error('Error creating destination:', ['error' => $e->getMessage()]);

            // Clean up uploaded files if creation fails
            foreach ($photoUrls as $url) {
                if ($url) {
                    $path = str_replace('storage/', 'public/', $url);
                    if (Storage::exists($path)) {
                        Storage::delete($path);
                    }
                }
            }

            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to add destination: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $destination_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        try {
            Log::info('Update Request Data:', $request->all());
            Log::info('Update Tag Value:', ['tag' => $request->tag, 'type' => gettype($request->tag)]);

            $request->validate([
                'name_package' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255|unique:destinations,slug,' . $destination_id . ',destination_id',
                'description' => 'nullable|string',
                'place' => 'required|string|max:255',
                'price' => 'nullable|numeric|min:0',
                'price_2' => 'nullable|numeric|min:0', // Kolom baru
                'destination_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'destination_photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kolom baru
                'destination_photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kolom baru
                'destination_photo_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kolom baru
                'remove_photo' => 'nullable|array', // Untuk menghapus foto 1-4
                'remove_photo.*' => 'in:destination_photo,destination_photo_2,destination_photo_3,destination_photo_4',
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
                'wna_wni_policy' => 'nullable|string', // Kolom baru
                'itinerary' => 'nullable|string',
                'tag' => 'nullable|string|max:500',
                'note' => 'nullable|string',
            ]);

            $destination = Destination::findOrFail($destination_id);

            // Simpan data lama untuk log
            $oldName = $destination->name_package;
            $oldPrice = $destination->price;
            $oldPrice2 = $destination->price_2; // Kolom baru
            $oldPlace = $destination->place;
            $oldPolicy = $destination->wna_wni_policy; // Kolom baru

            try {
                $oldTags = $destination->tag ?? 'none';
            } catch (\Exception $e) {
                Log::error('Error getting old tags:', ['error' => $e->getMessage()]);
                $oldTags = 'none';
            }

            // Parse prices
            $price = $request->price !== null ? (float) str_replace(['.', ','], '', $request->price) : $destination->price;
            $price_2 = $request->price_2 !== null ? (float) str_replace(['.', ','], '', $request->price_2) : $destination->price_2; // Kolom baru

            // Proses tag
            try {
                $tagString = !empty(trim($request->tag)) ? trim($request->tag) : null;
                $newTags = $tagString ?? 'none';
                Log::info('Processed Update Tag:', ['tagString' => $tagString]);
            } catch (\Exception $e) {
                Log::error('Error processing update tag:', ['error' => $e->getMessage(), 'tag' => $request->tag]);
                $tagString = $destination->tag; // Keep old value if error
                $newTags = $oldTags;
            }

            $updateData = [
                'name_package' => $request->name_package,
                'slug' => $request->slug ?? Str::slug($request->name_package),
                'description' => $request->description,
                'place' => $request->place,
                'price' => $price,
                'price_2' => $price_2, // Kolom baru
                'time' => $request->time,
                'category' => $request->category,
                'level' => $request->level,
                'pickup_points' => $request->pickup_points,
                'dropoff_points' => $request->dropoff_points,
                'activities' => $request->activities,
                'transportation' => $request->transportation,
                'accommodation' => $request->accommodation,
                'consumption' => $request->consumption,
                'include' => $request->include,
                'exclude' => $request->exclude,
                'wna_wni_policy' => $request->wna_wni_policy, // Kolom baru
                'itinerary' => $request->itinerary,
                'tag' => $tagString,
                'note' => $request->note,
            ];
            
            // Handle photo uploads dan deletions (untuk 4 foto)
            $photoChanged = false;
            $photoFields = ['destination_photo', 'destination_photo_2', 'destination_photo_3', 'destination_photo_4'];

            foreach ($photoFields as $field) {
                // 1. Logika Hapus Foto
                if ($request->filled('remove_photo') && in_array($field, $request->remove_photo)) {
                    if ($destination->{$field}) {
                        $oldPath = str_replace('storage/', 'public/', $destination->{$field});
                        if (Storage::exists($oldPath)) {
                            Storage::delete($oldPath);
                            $updateData[$field] = null;
                            $photoChanged = true;
                        }
                    }
                }

                // 2. Logika Upload/Ganti Foto
                if ($request->hasFile($field)) {
                    try {
                        // Hapus foto lama (jika ada) sebelum mengunggah yang baru
                        if ($destination->{$field}) {
                            $oldPath = str_replace('storage/', 'public/', $destination->{$field});
                            if (Storage::exists($oldPath)) {
                                Storage::delete($oldPath);
                            }
                        }

                        $imagePath = $request->file($field)->store('public/destinations');
                        $updateData[$field] = str_replace('public/', 'storage/', $imagePath);
                        $photoChanged = true;

                    } catch (\Exception $e) {
                        Log::error("Error handling photo upload for {$field}:", ['error' => $e->getMessage()]);
                        // Jika upload foto gagal, return error
                        return back()->withInput()
                            ->with('toast', ['type' => 'error', 'message' => "Failed to upload photo ({$field}): " . $e->getMessage()]);
                    }
                }
                
                // Pastikan nilai foto saat ini dipertahankan jika tidak ada perubahan/penghapusan
                if (!isset($updateData[$field])) {
                     $updateData[$field] = $destination->{$field};
                }
            }


            // Ensure slug is unique
            try {
                $slug = $updateData['slug'];
                $slugCount = Destination::where('slug', $slug)
                    ->where('destination_id', '!=', $destination_id)
                    ->count();
                if ($slugCount > 0) {
                    $updateData['slug'] = $slug . '-' . uniqid();
                }
            } catch (\Exception $e) {
                Log::error('Error checking slug uniqueness:', ['error' => $e->getMessage()]);
            }

            $destination->update($updateData);

            // Log changes
            $changes = [];
            if ($oldName !== $updateData['name_package']) {
                $changes[] = "name: '{$oldName}' → '{$updateData['name_package']}'";
            }
            if ($oldPrice != $price) {
                $changes[] = "price 1: {$oldPrice} → {$price}";
            }
            if ($oldPrice2 != $price_2) {
                $changes[] = "price 2: {$oldPrice2} → {$price_2}";
            }
            if ($oldPlace !== $request->place) {
                $changes[] = "place: '{$oldPlace}' → '{$request->place}'";
            }
            if ($oldPolicy !== $request->wna_wni_policy) {
                $changes[] = "policy: '{$oldPolicy}' → '{$request->wna_wni_policy}'";
            }
            if ($photoChanged) {
                $changes[] = "photos updated/removed";
            }
            if ($oldTags != $newTags) {
                $changes[] = "tags: '{$oldTags}' → '{$newTags}'";
            }

            $changeText = !empty($changes) ? ' (' . implode(', ', $changes) . ')' : '';

            try {
                LogActivity::create([
                    'username' => $currentUser->username,
                    'action' => 'Updated destination: "' . Str::limit($updateData['name_package'], 50) . '"' . $changeText,
                ]);
            } catch (\Exception $e) {
                Log::error('Error creating update log activity:', ['error' => $e->getMessage()]);
            }

            return redirect()->route('manage-destination.index')
                ->with('toast', ['type' => 'success', 'message' => 'Destination updated successfully']);
        } catch (\Exception $e) {
            Log::error('Error updating destination:', ['error' => $e->getMessage()]);
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
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        try {
            $destination = Destination::findOrFail($destination_id);
            $deletedName = $destination->name_package;
            $deletedPlace = $destination->place;

            // Delete all 4 photos
            $photoFields = ['destination_photo', 'destination_photo_2', 'destination_photo_3', 'destination_photo_4'];
            foreach ($photoFields as $field) {
                if ($destination->{$field}) {
                    $path = str_replace('storage/', 'public/', $destination->{$field});
                    if (Storage::exists($path)) {
                        Storage::delete($path);
                    }
                }
            }

            $destination->delete();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Deleted destination: "' . $deletedName . '" in ' . $deletedPlace,
            ]);

            return redirect()->route('manage-destination.index')
                ->with('toast', ['type' => 'success', 'message' => 'Destination deleted successfully']);
        } catch (\Exception $e) {
            return back()->with('toast', ['type' => 'error', 'message' => 'Failed to delete destination: ' . $e->getMessage()]);
        }
    }

    public function duplicate(Request $request, $destination_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'toast' => ['type' => 'error', 'message' => 'Unauthorized.']
                ], 401);
            }
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to perform this action.']);
        }

        try {
            $original = Destination::findOrFail($destination_id);

            $newName = 'Copy of ' . $original->name_package;

            $baseSlug = Str::slug($newName);
            $slug = $baseSlug;
            $counter = 1;
            while (Destination::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            $duplicate = $original->replicate();
            $duplicate->name_package = $newName;
            $duplicate->slug = $slug;

            // SALIN SEMUA 4 FILE GAMBAR FISIK
            $photoFields = ['destination_photo', 'destination_photo_2', 'destination_photo_3', 'destination_photo_4'];

            foreach ($photoFields as $field) {
                if ($original->{$field}) {
                    $sourcePath = str_replace('storage/', 'public/', $original->{$field});

                    if (Storage::exists($sourcePath)) {
                        $originalFileName = basename($original->{$field});
                        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                        $nameWithoutExt = pathinfo($originalFileName, PATHINFO_FILENAME);

                        $newFileName = 'copy_' . Str::slug($nameWithoutExt) . '_' . time() . '_' . $field . '.' . $extension;
                        $newStoragePath = 'public/destinations/' . $newFileName;

                        Storage::copy($sourcePath, $newStoragePath);

                        $duplicate->{$field} = str_replace('public/', 'storage/', $newStoragePath);
                    } else {
                        $duplicate->{$field} = null;
                    }
                }
            }

            $duplicate->save();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Duplicated destination: "' . $original->name_package . '" → "' . $newName . '"',
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'toast' => ['type' => 'success', 'message' => 'Destination duplicated successfully!']
                ]);
            }

            return redirect()->route('manage-destination.index')
                ->with('toast', ['type' => 'success', 'message' => 'Destination duplicated successfully!']);
        } catch (\Exception $e) {
            Log::error('Error duplicating destination:', ['error' => $e->getMessage()]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'toast' => ['type' => 'error', 'message' => 'Failed to duplicate destination: ' . $e->getMessage()]
                ], 500);
            }

            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Failed to duplicate destination.'
            ]);
        }
    }
    public function bulkDestroy(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'toast' => ['type' => 'error', 'message' => 'Unauthorized.']
                ], 401);
            }
            return redirect()->route('login')->with('toast', [
                'type' => 'error',
                'message' => 'You do not have permission to view this page.'
            ]);
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:destinations,destination_id',
        ]);

        try {
            $destinations = Destination::whereIn('destination_id', $request->ids)->get();

            $deletedCount = $destinations->count();
            $deletedNames = $destinations->pluck('name_package')->join(', ');

            // Hapus semua 4 foto untuk setiap destinasi
            $photoFields = ['destination_photo', 'destination_photo_2', 'destination_photo_3', 'destination_photo_4'];
            
            foreach ($destinations as $destination) {
                foreach ($photoFields as $field) {
                    if ($destination->{$field}) {
                        $path = str_replace('storage/', 'public/', $destination->{$field});
                        if (Storage::exists($path)) {
                            Storage::delete($path);
                        }
                    }
                }
                $destination->delete();
            }

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Bulk deleted {$deletedCount} destination(s): " . $deletedNames,
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'toast' => ['type' => 'success', 'message' => 'Selected destinations deleted successfully']
                ]);
            }

            return redirect()->route('manage-destination.index')->with('toast', [
                'type' => 'success',
                'message' => 'Selected destinations deleted successfully'
            ]);
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'toast' => ['type' => 'error', 'message' => 'Failed to bulk delete: ' . $e->getMessage()]
                ], 500);
            }

            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Failed to bulk delete destinations.'
            ]);
        }
    }
}