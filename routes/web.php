<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\GalleriesController;
use App\Http\Controllers\admin\DestinationController;

use Illuminate\Support\Facades\Route;

// User-Route
Route::resource('/', HomeController::class);

// Admin Route

// Auth-Admin
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard
Route::resource('/dashboard', DashboardController::class);
// Manage Users
Route::resource('/manage-user', UserController::class);
Route::delete('/manage-user/bulk-destroy', [UserController::class, 'bulkDestroy'])->name('manage-user.bulk-destroy');
// Manage Bookings
Route::resource('/manage-booking', BookingController::class);
// Manage Gallery
Route::resource('/manage-gallery', GalleriesController::class);
Route::delete('/manage-gallery/bulk-destroy', [GalleriesController::class, 'bulkDestroy'])->name('manage-gallery.bulk-destroy');
// Manage Testimoni
// Manage Blog
//Manage Destination
Route::resource('/manage-destination', DestinationController::class);
Route::delete('/manage-destination/bulk-destroy', [DestinationController::class, 'bulkDestroy'])->name('manage-destination.bulk-destroy');

// Manage Tours