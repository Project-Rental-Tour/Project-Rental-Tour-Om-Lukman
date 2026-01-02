<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Gallery;
use App\Models\LogActivity;
use App\Models\Profile;

class GalleriesController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $query = Gallery::query();

        $profiles = Profile::find(1) ?? Profile::first();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title-asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title-desc':
                $query->orderBy('title', 'desc');
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
            'action' => 'Viewed Gallery list (filtered: ' . ($request->filled('search') ? 'yes' : 'no') . ')'
        ]);

        $galleries = $query->paginate(25)->appends($request->except('page'));
        return view('Admin.manageGallery', compact('galleries', 'notifications', 'profiles'));
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'gallery_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tag' => 'nullable|string|max:500', // tambahkan validasi tag
        ]);

        try {
            $imagePath = $request->file('gallery_photo')->store('public/galleries');
            $photoPath = str_replace('public/', 'storage/', $imagePath);

            // Proses tag → pecah jadi array, filter kosong, trim


            $gallery = Gallery::create([
                'title' => $validated['title'],
                'gallery_photo' => $photoPath,
                'tag' => $validated['tag'], // simpan sebagai JSON array
            ]);

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Added gallery item: "' . $gallery->title  . '" with tags: ' . ', ',
                $gallery->tag
            ]);

            return redirect()->route('manage-gallery.index')
                ->with('toast', ['type' => 'success', 'message' => 'Gallery item added successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to upload: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $gallery_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'gallery_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tag' => 'nullable|string|max:500',
        ]);

        try {
            $gallery = Gallery::findOrFail($gallery_id);
            $oldTitle = $gallery->title;

            $updateData = [
                'title' => $validated['title'],
                'tag' => $validated['tag'] ?? null,
            ];

            // Proses tag


            if ($request->hasFile('gallery_photo')) {
                Storage::delete(str_replace('storage/', 'public/', $gallery->gallery_photo));
                $imagePath = $request->file('gallery_photo')->store('public/galleries');
                $updateData['gallery_photo'] = str_replace('public/', 'storage/', $imagePath);
            }

            $gallery->update($updateData);

            $logAction = "Updated gallery item: '{$oldTitle}'";
            if ($oldTitle !== $validated['title']) {
                $logAction = "Updated gallery item: '{$oldTitle}' → '{$validated['title']}'";
            }
            if ($request->hasFile('gallery_photo')) {
                $logAction .= " (new image)";
            }
            if (!empty($tags)) {
                $logAction =   ', ' . $tags;
            }

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => $logAction,
            ]);

            return redirect()->route('manage-gallery.index')
                ->with('toast', ['type' => 'success', 'message' => 'Gallery updated successfully']);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('toast', ['type' => 'error', 'message' => 'Update failed: ' . $e->getMessage()]);
        }
    }

    public function destroy($gallery_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        try {
            $gallery = Gallery::findOrFail($gallery_id);
            $deletedTitle = $gallery->title;

            // Hapus file
            Storage::delete(str_replace('storage/', 'public/', $gallery->gallery_photo));
            $gallery->delete();

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Deleted gallery item: "' . $deletedTitle . '"',
            ]);

            return redirect()->route('manage-gallery.index')
                ->with('toast', ['type' => 'success', 'message' => 'Gallery deleted successfully']);
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
            'ids.*' => 'exists:galleries,gallery_id',
        ]);

        try {
            $galleries = Gallery::whereIn('gallery_id', $validated['ids'])->get();

            if ($galleries->isEmpty()) {
                return redirect()->back()->with('toast', [
                    'type' => 'error',
                    'message' => 'No gallery items selected.'
                ]);
            }

            $deletedTitles = $galleries->pluck('title');
            $count = $galleries->count();

            foreach ($galleries as $gallery) {
                Storage::delete(str_replace('storage/', 'public/', $gallery->gallery_photo));
                $gallery->delete();
            }

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Bulk deleted {$count} gallery item(s): " . $deletedTitles->join(', '),
            ]);

            if (!$request->expectsJson()) {
                return redirect()->route('manage-gallery.index')->with('toast', [
                    'type' => 'success',
                    'message' => "{$count} gallery item(s) deleted successfully."
                ]);
            }

            return response()->json([
                'success' => true,
                'toast' => [
                    'type' => 'success',
                    'message' => "{$count} gallery item(s) deleted successfully."
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

    public function bulkCompress(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:galleries,gallery_id',
        ]);

        try {
            $galleries = Gallery::whereIn('gallery_id', $request->ids)->get();
            $count = 0;

            foreach ($galleries as $gallery) {
                if ($gallery->gallery_photo) {
                    // Ambil path asli (storage/...) ubah ke path fisik (public/...)
                    $relativePath = str_replace('storage/', 'public/', $gallery->gallery_photo);
                    
                    if (Storage::exists($relativePath)) {
                        // Ambil file fisik
                        $fileContent = Storage::get($relativePath);
                        $absolutePath = Storage::path($relativePath);
                        
                        // Cek ukuran file saat ini (dalam bytes)
                        $currentSize = filesize($absolutePath);
                        
                        // Jika ukuran > 500KB (512000 bytes), lakukan kompresi ulang
                        if ($currentSize > 512000) {
                            // Panggil helper processImage yang sudah kita buat sebelumnya
                            // Kita kirim path absolut file-nya
                            // Note: Kita perlu sedikit modifikasi helper processImage agar support path file, 
                            // atau kita buat logika simple disini:
                            
                            $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                            $image = $manager->read($absolutePath);

                            // Resize jika terlalu besar
                            if ($image->width() > 1920) {
                                $image->scale(width: 1920);
                            }

                            // Iterasi Kompresi
                            $quality = 80;
                            $targetSize = 500 * 1024; // 500KB
                            
                            do {
                                $encoded = $image->toJpeg($quality);
                                $size = strlen((string) $encoded);
                                $quality -= 5;
                            } while ($size > $targetSize && $quality >= 15);

                            // Timpa file lama dengan hasil kompresi
                            Storage::put($relativePath, (string) $encoded);
                            $count++;
                        }
                    }
                }
            }

            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Bulk compressed {$count} image(s) to under 500KB.",
            ]);

            return response()->json([
                'success' => true, 
                'toast' => ['type' => 'success', 'message' => "{$count} images compressed successfully."]
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
