<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\LogActivity;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.LoginAdmin');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|exists:users,username',
            'password' => 'required|string|min:8',
        ], [
            'username.required' => 'Username is required.',
            'username.exists' => 'The username you entered does not exist.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
        ]);

        if ($validator->fails()) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => $validator->errors()->first()
            ])->withInput();
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            LogActivity::create([
                'username' => $request->username,
                'action' => 'Admin logged in',
            ]);

            return redirect()->intended('dashboard')->with('toast', [
                'type' => 'success',
                'message' => 'Login successful. Welcome back!'
            ]);
        }

        LogActivity::create([
            'username' => $request->username,
            'action' => 'Failed login attempt',
        ]);

        return back()->with('toast', [
            'type' => 'error',
            'message' => 'Invalid username or password. Please try again.'
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        $username = Auth::user()->username;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        LogActivity::create([
            'username' => $username,
            'action' => 'Admin logged out',
        ]);

        return redirect('/login')->with('toast', [
            'type' => 'info',
            'message' => 'You have been logged out.'
        ]);
    }
}
