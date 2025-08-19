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
    public function index()
    {
        $currentUsers = Auth::user();
        if (!$currentUsers) {
            return redirect()->route('login.showLoginForm')->withErrors(['error' => 'You do not have permission to view this page.']);
        }

        $users = User::all(); // Assuming you have a User model to fetch users

        return view('admin.manageUser', compact('users'));
    }

    public function store(Request $request)
    {
        $currentUsers = Auth::user();
        if (!$currentUsers) {
            return redirect()->route('login.showLoginForm')->withErrors(['error' => 'You do not have permission to view this page.']);
        }

        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        if ($validated['password'] !== $request->input('password_confirmation')) {
            return redirect()->back()->withErrors(['password' => 'Passwords do not match.']);
        }

        User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
        ]);


        return redirect()->route('manage-user.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, $user_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'You do not have permission to view this page.']);
        }

        try {
            // Validate input
            $validated = $request->validate([
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($user_id, 'user_id')
                ],
            ]);

            $userToUpdate = User::findOrFail($user_id);

            // Check if current user can update this profile
            if ($currentUser->user_id != $userToUpdate->user_id) {
                return back()
                    ->withErrors(['error' => 'You can only update your own profile.'])
                    ->withInput();
            } else {

                $userToUpdate->update([
                    'username' => $validated['username']
                ]);

                return back()
                    ->with('success', 'Profile updated successfully.');
            }
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to update profile. Please try again.'])
                ->withInput();
        }
    }

    public function destroy($user_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return redirect()->route('login.showLoginForm')
                ->withErrors(['error' => 'You do not have permission to view this page.']);
        }

        try {
            // Dapatkan user yang ingin dihapus
            $userToDelete = User::findOrFail($user_id);

            // Periksa apakah user mencoba menghapus dirinya sendiri
            if ($currentUser->user_id == $userToDelete->user_id) {
                return redirect()->route('manage-user.index')
                    ->withErrors(['error' => 'You cannot delete your own account.']);
            }

            // Hanya admin yang bisa menghapus user lain
            if ($currentUser->user_id != $userToDelete->user_id) {
                $userToDelete->delete();
                return redirect()->route('manage-user.index')
                    ->with('success', 'User has been deleted successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->route('manage-user.index')
                ->withErrors(['error' => 'Failed to delete user.']);
        }
    }
}
