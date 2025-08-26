<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('username', 'like', "%{$search}%");
        }

        $users = $query->paginate(25)->appends($request->query());
        return view('admin.manageUser', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        if ($validated['password'] !== $request->input('password_confirmation')) {
            return redirect()->back()
                ->with('toast', ['type' => 'error', 'message' => 'Passwords do not match.']);
        }

        try {
            User::create([
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']),
            ]);

            return redirect()->route('manage-user.index')
                ->with('toast', ['type' => 'success', 'message' => 'User has been created successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to create user: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, $user_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        try {
            $validated = $request->validate([
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($user_id, 'user_id')
                ],
            ]);

            $userToUpdate = User::findOrFail($user_id);

            if ($currentUser->user_id != $userToUpdate->user_id) {
                return back()
                    ->with('toast', ['type' => 'error', 'message' => 'You can only update your own profile.'])
                    ->withInput();
            }

            $userToUpdate->update([
                'username' => $validated['username']
            ]);

            return back()
                ->with('toast', ['type' => 'success', 'message' => 'Profile has been updated successfully.']);
        } catch (\Exception $e) {
            return back()
                ->with('toast', ['type' => 'error', 'message' => 'Failed to update profile: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($user_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        try {
            $userToDelete = User::findOrFail($user_id);

            if ($currentUser->user_id == $userToDelete->user_id) {
                return redirect()->route('manage-user.index')
                    ->with('toast', ['type' => 'error', 'message' => 'You cannot delete your own account.']);
            }

            $userToDelete->delete();

            return redirect()->route('manage-user.index')
                ->with('toast', ['type' => 'success', 'message' => 'User has been deleted successfully.']);
        } catch (\Exception $e) {
            return redirect()->route('manage-user.index')
                ->with('toast', ['type' => 'error', 'message' => 'Failed to delete user: ' . $e->getMessage()]);
        }
    }

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
            'ids.*' => 'exists:users,user_id',
        ]);

        try {
            $ids = $request->ids;

            // Pastikan admin tidak menghapus akun sendiri
            if (in_array($currentUser->user_id, $ids)) {
                return response()->json([
                    'success' => false,
                    'toast' => ['type' => 'error', 'message' => 'You cannot delete your own account.']
                ], 400);
            }

            $count = User::whereIn('user_id', $ids)->count();
            User::whereIn('user_id', $ids)->delete();

            return response()->json([
                'success' => true,
                'toast' => ['type' => 'success', 'message' => "Successfully deleted {$count} user(s)."]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'toast' => ['type' => 'error', 'message' => 'Failed to bulk delete users: ' . $e->getMessage()]
            ], 500);
        }
    }
}
