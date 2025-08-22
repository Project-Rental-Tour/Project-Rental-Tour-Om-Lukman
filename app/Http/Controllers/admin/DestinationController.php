<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')
                ->withErrors(['error' => 'You need to login first']);
        }

        $destinations = Destination::paginate(25);
        return view('admin.manageDestination', compact('destinations'));
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Unauthorized access']);
        }

        $request->validate([
            'name_package' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'destination_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'time' => 'required|string|max:255',
            'facility' => 'required|string|max:255',
        ]);

        try {
            $imagePath = $request->file('destination_photo')->store('public/destinations');

            // Handle nullable price
            $price = $request->price;
            if ($price !== null) {
                $price = (float) $price;
            }

            Destination::create([
                'name_package' => $request->name_package,
                'place' => $request->place,
                'price' => $price,
                'destination_photo' => str_replace('public/', 'storage/', $imagePath),
                'time' => $request->time,
                'facility' => $request->facility,
            ]);

            return redirect()->route('manage-destination.index')
                ->with('success', 'Destination added successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to upload: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, $destination_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Unauthorized access']);
        }

        // Validasi input
        $request->validate([
            'name_package' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'destination_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'time' => 'required|string|max:255',
            'facility' => 'required|string|max:255',
        ]);

        try {
            $destination = Destination::findOrFail($destination_id);

            // Handle nullable price
            $price = $request->price;
            if ($price !== null) {
                // Format ulang harga (hapus titik dan koma, kemudian konversi ke float)
                $price = str_replace(['.', ','], '', $price);
                $price = (float) $price;
            }

            $updateData = [
                'name_package' => $request->name_package,
                'place' => $request->place,
                'price' => $price, // Bisa berupa float atau null
                'time' => $request->time,
                'facility' => $request->facility,
            ];

            if ($request->hasFile('destination_photo')) {
                // Delete old image
                if ($destination->destination_photo) {
                    $oldImagePath = str_replace('storage/', 'public/', $destination->destination_photo);
                    if (Storage::exists($oldImagePath)) {
                        Storage::delete($oldImagePath);
                    }
                }

                // Store new image
                $imagePath = $request->file('destination_photo')->store('public/destinations');
                $updateData['destination_photo'] = str_replace('public/', 'storage/', $imagePath);
            }

            $destination->update($updateData);

            return redirect()->route('manage-destination.index')
                ->with('success', 'Destination updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Update failed: ' . $e->getMessage()]);
        }
    }

    public function destroy($destination_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Unauthorized access']);
        }

        try {
            $destination = Destination::findOrFail($destination_id);

            // Delete associated image
            if ($destination->destination_photo) {
                Storage::delete(str_replace('storage/', 'public/', $destination->destination_photo));
            }

            $destination->delete();

            return redirect()->route('manage-destination.index')
                ->with('success', 'Destination deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Delete failed: ' . $e->getMessage()]);
        }
    }

    public function bulkDestroy(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:destinations,destination_id',
        ]);

        try {
            $destinations = Destination::whereIn('destination_id', $request->ids)->get();

            foreach ($destinations as $destination) {
                // Delete associated image
                if ($destination->destination_photo) {
                    Storage::delete(str_replace('storage/', 'public/', $destination->destination_photo));
                }
                $destination->delete();
            }

            return response()->json(['success' => 'Selected destinations deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Bulk delete failed: ' . $e->getMessage()], 500);
        }
    }
}
