<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.LoginAdmin');
    }

    public function login(Request $request)
    {
        // Validate the login form
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|exists:users,username',
            'password' => 'required|string|min:8',
        ], [
            'username.required' => 'Username is required.',
            'username.exists' => 'The username you entered does not exist.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => $validator->errors()->first() // Ambil pesan error pertama
            ])->withInput();
        }

        // Get credentials
        $credentials = $request->only('username', 'password');

        // Attempt to log in
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('toast', [
                'type' => 'success',
                'message' => 'Login successful. Welcome back!'
            ]);
        }

        // Authentication failed
        return back()->with('toast', [
            'type' => 'error',
            'message' => 'Invalid username or password. Please try again.'
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
