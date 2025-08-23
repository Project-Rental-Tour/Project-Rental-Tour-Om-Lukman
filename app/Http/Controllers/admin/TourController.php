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
            Tour::create([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'facility' => $request->facility
            ]);

            return redirect()->route('manage-tour.index')
                ->with('toast', ['type' => 'success', 'message' => 'Tour has been added successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to add tour: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, $tour_id)
    {
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
            $tour = Tour::findOrFail($tour_id);
            $tour->update([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'facility' => $request->facility
            ]);

            return redirect()->route('manage-tour.index')
                ->with('toast', ['type' => 'success', 'message' => 'Tour has been updated successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to update tour: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($tour_id)
    {
        try {
            $tour = Tour::findOrFail($tour_id);
            $tour->delete();

            return redirect()->route('manage-tour.index')
                ->with('toast', ['type' => 'success', 'message' => 'Tour has been deleted successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to delete tour: ' . $e->getMessage()]);
        }
    }

    public function bulkDestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tour_ids' => 'required|array',
            'tour_ids.*' => 'exists:tours,tour_id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('toast', ['type' => 'error', 'message' => 'Invalid selected data!']);
        }

        try {
            Tour::whereIn('tour_id', $request->tour_ids)->delete();

            return redirect()->route('manage-tour.index')
                ->with('toast', ['type' => 'success', 'message' => 'Selected tours have been deleted successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('toast', ['type' => 'error', 'message' => 'Bulk delete failed: ' . $e->getMessage()]);
        }
    }
}
