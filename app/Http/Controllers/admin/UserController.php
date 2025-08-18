<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Assuming you have a User model to fetch users

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
            return redirect()->back()->withErrors(['password' => 'Passwords do not match.']);
        }

        User::create([
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
        ]);


        return redirect()->route('manage-user.index')->with('success', 'User created successfully.');
    }

    // public function update($user_id)
    // {
    //     // Dapatkan user yang sedang login
    //     $currentUser = auth()->user();

    //     // Dapatkan user yang ingin diupdate
    //     $userToUpdate = User::findOrFail($user_id);

    //     // Periksa apakah user yang login sama dengan user yang ingin diupdate
    //     if ($currentUser->id != $userToUpdate->id) {
    //         return back()->withErrors(['error' => 'You can only update your own profile.']);
    //     }

    //     $userToUpdate->username = request('username');
    //     $userToUpdate->save();

    //     return back()->with('success', 'Profile updated successfully.');
    // }

    // public function destroy($user_id)
    // {
    //     // Dapatkan user yang sedang login
    //     $currentUser = auth()->user();

    //     // Dapatkan user yang ingin dihapus
    //     $userToDelete = User::findOrFail($user_id);

    //     // Periksa apakah user yang login sama dengan user yang ingin dihapus
    //     if ($currentUser->id != $userToDelete->id) {
    //         return redirect()->route('manage-user.index')
    //             ->withErrors(['error' => 'You can only delete your own account.']);
    //     }

    //     $userToDelete->delete();

    //     // Logout user setelah menghapus akun
    //     auth()->logout();

    //     return redirect()->route('login')
    //         ->with('success', 'Your account has been deleted successfully.');
    // }
}
