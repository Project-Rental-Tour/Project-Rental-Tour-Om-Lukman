<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageHelper
{
    /**
     * Convert and store an uploaded image to WebP format.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder Relative path within storage/app/public
     * @param int $quality
     * @return string|null Path to the stored file (starting with storage/)
     */
    public static function convertToWebp($file, $folder, $quality = 80)
    {
        try {
            if (!$file) return null;

            // Create manager with GD driver
            $manager = new ImageManager(new Driver());

            // Read the image
            $image = $manager->read($file);

            // Generate unique filename
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = preg_replace('/[^A-Za-z0-9\-]/', '', $filename); // Cleanup
            $filename = time() . '_' . $filename . '.webp';
            
            // Ensure folder exists in public disk
            $directory = 'public/' . trim($folder, '/');
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            $path = $directory . '/' . $filename;

            // Convert to webp and save
            $encoded = $image->toWebp($quality);
            Storage::put($path, (string) $encoded);

            // Return the storage path
            return 'storage/' . trim($folder, '/') . '/' . $filename;
        } catch (\Exception $e) {
            \Log::error('WebP Conversion Error: ' . $e->getMessage());
            // Fallback to original storage if conversion fails
            $path = $file->store('public/' . $folder);
            return str_replace('public/', 'storage/', $path);
        }
    }
}
