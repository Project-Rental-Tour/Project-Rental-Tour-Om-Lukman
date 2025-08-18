<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\auth\AuthController;

use Illuminate\Support\Facades\Route;

// User-Route
Route::resource('/', HomeController::class);

// Admin Route

// Auth-Admin
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::resource('/dashboard', DashboardController::class);
Route::resource('/manage-user', UserController::class);
Route::delete('/manage-user/bulk-destroy', [UserController::class, 'bulkDestroy'])->name('manage-user.bulk-destroy');
