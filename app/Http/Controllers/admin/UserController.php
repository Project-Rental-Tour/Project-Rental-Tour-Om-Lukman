<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\LogActivity;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('username', 'like', "%{$search}%");
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'username-asc':
                $query->orderBy('username', 'asc');
                break;
            case 'username-desc':
                $query->orderBy('username', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $users = $query->paginate(25)->appends($request->except('page'));
        return view('admin.manageUser', compact('users'));
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            $user = User::create([
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']),
            ]);

            // 🔥 Catat log: Admin tambah user
            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Created user: ' . $user->username,
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
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
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

            $oldUsername = $userToUpdate->username;
            $userToUpdate->update($validated);

            // 🔥 Catat log: Admin edit username
            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Edited user: {$oldUsername} → {$userToUpdate->username}",
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
            return redirect()->route('login')->with('toast', ['type' => 'error', 'message' => 'You do not have permission to view this page.']);
        }

        try {
            $userToDelete = User::findOrFail($user_id);

            if ($currentUser->user_id == $userToDelete->user_id) {
                return redirect()->route('manage-user.index')
                    ->with('toast', ['type' => 'error', 'message' => 'You cannot delete your own account.']);
            }

            $deletedUsername = $userToDelete->username;
            $userToDelete->delete();

            // 🔥 Catat log: Admin hapus user
            LogActivity::create([
                'username' => $currentUser->username,
                'action' => 'Deleted user: ' . $deletedUsername,
            ]);

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
                'toast' => ['type' => 'error', 'message' => 'You do not have permission to view this page.']
            ], 401);
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,user_id',
        ]);

        try {
            $ids = $request->ids;

            if (in_array($currentUser->user_id, $ids)) {
                return response()->json([
                    'success' => false,
                    'toast' => ['type' => 'error', 'message' => 'You cannot delete your own account.']
                ], 400);
            }

            $deletedUsernames = User::whereIn('user_id', $ids)->pluck('username');
            $count = $deletedUsernames->count();

            User::whereIn('user_id', $ids)->delete();

            // 🔥 Catat log: Bulk delete
            LogActivity::create([
                'username' => $currentUser->username,
                'action' => "Bulk deleted {$count} user(s): " . $deletedUsernames->join(', '),
            ]);

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
