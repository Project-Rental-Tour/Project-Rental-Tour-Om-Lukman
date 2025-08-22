<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Validator;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::paginate(25);
        return view('admin.manageTour', compact('tours'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:100',
            'facility' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Membuat tour baru
            Tour::create([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'facility' => $request->facility
            ]);

            return redirect()->route('manage-tour.index')
                ->with('success', 'Tour berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, $tour_id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:100',
            'facility' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Mencari tour berdasarkan ID
            $tour = Tour::findOrFail($tour_id);

            // Memperbarui data tour
            $tour->update([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'facility' => $request->facility
            ]);

            return redirect()->route('manage-tour.index')
                ->with('success', 'Tour berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($tour_id)
    {
        try {
            // Mencari tour berdasarkan ID
            $tour = Tour::findOrFail($tour_id);

            // Menghapus tour
            $tour->delete();

            return redirect()->route('manage-tour.index')
                ->with('success', 'Tour berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function bulkDestroy(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'tour_ids' => 'required|array',
            'tour_ids.*' => 'exists:tours,tour_id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', 'Data yang dipilih tidak valid!');
        }

        try {
            // Menghapus multiple tours
            Tour::whereIn('tour_id', $request->tour_ids)->delete();

            return redirect()->route('manage-tour.index')
                ->with('success', 'Tour yang dipilih berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
