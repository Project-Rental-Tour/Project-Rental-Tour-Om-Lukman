<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\TestimoniController;
use App\Http\Controllers\admin\TourController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\GalleriesController;
use App\Http\Controllers\admin\DestinationController;
use Illuminate\Support\Facades\Route;

// User-Route
Route::resource('/', HomeController::class);
Route::get('/blog/{slug}', [BlogController::class, 'detailBlog'])->name('blog.detail-blog');

Route::get('/destinations/{slug}', [DestinationController::class, 'detailDestination'])->name('destination.show');
Route::get('/destinations/{slug}/book', [BookingController::class, 'showRegularForm'])->name('booking.regular.form');
Route::post('/booking/regular', [BookingController::class, 'bookingRegular'])->name('booking.regular.store');

Route::get('/custom-trip', [BookingController::class, 'showCustomForm'])->name('booking.custom');
Route::post('/booking/custom', [BookingController::class, 'bookingCustom'])->name('booking.custom.store');


// Auth-Admin
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Admin Routes - Protected by auth middleware
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard/profile/update', [DashboardController::class, 'update'])->name('dashboard.profile.update');

    // Manage Users - INI HARUS DI DALAM MIDDLEWARE AUTH
    Route::delete('/manage-user/bulk-destroy', [UserController::class, 'bulkDestroy'])->name('manage-user.bulk-destroy');
    Route::resource('/manage-user', UserController::class);

    // Manage Bookings
    Route::get('/manage-booking/bulk-destroy', [BookingController::class, 'bulkDestroy'])->name('manage-booking.bulk-destroy');
    Route::get('/manage-booking', [BookingController::class, 'index'])->name('manage-booking.index');

    // Manage Gallery
    Route::delete('/manage-gallery/bulk-destroy', [GalleriesController::class, 'bulkDestroy'])->name('manage-gallery.bulk-destroy');
    Route::resource('/manage-gallery', GalleriesController::class);

    // Manage Testimoni
    Route::delete('/manage-testimonials/bulk-destroy', [TestimoniController::class, 'bulkDestroy'])->name('manage-testimonials.bulk-destroy');
    Route::resource('/manage-testimonials', TestimoniController::class);

    // Manage Blog
    Route::delete('/manage-blog/bulk-destroy', [BlogController::class, 'bulkDestroy'])->name('manage-blog.bulk-destroy');
    Route::resource('/manage-blog', BlogController::class);

    // Manage Destination
    Route::delete('/manage-destination/bulk-destroy', [DestinationController::class, 'bulkDestroy'])->name('manage-destination.bulk-destroy');
    Route::resource('/manage-destination', DestinationController::class);
});
