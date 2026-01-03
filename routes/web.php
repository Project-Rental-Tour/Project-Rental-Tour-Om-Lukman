<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\TestimoniController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\CarController;
use App\Http\Controllers\admin\GalleriesController;
use App\Http\Controllers\admin\DestinationController;
use App\Http\Controllers\admin\BookingCarController;
use App\Http\Controllers\user\UserCarController;
use App\Http\Controllers\user\UserGalleryController;
use App\Http\Controllers\user\UserDestinationController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\user\UserBlogController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// User-Route
Route::get('/test', function () {
    return 'OK';
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        Session::put('app_locale', $locale);
    }
    return redirect()->back();
})->name('switch.language');

Route::resource('/', HomeController::class);
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/gallery', [UserGalleryController::class, 'index'])->name('gallery.index');
Route::get('/list-car', [UserCarController::class, 'index'])->name('usercar.index');
Route::get('/tour-package', [UserDestinationController::class, 'index'])->name('destination.index');

Route::get('/blog', [UserBlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{slug}', [UserBlogController::class, 'detailBlog'])->name('blogs.detail');

Route::get('/rent-car/{slug}', [UserCarController::class, 'detailCar'])->name('car.detail');
Route::get('/rent-car-booking/{slug}', [BookingCarController::class, 'booking'])->name('booking-car.form');
Route::post('/rent-car-booking', [BookingCarController::class, 'bookingStore'])->name('bookingStore');

Route::get('/tour-package/{slug}', [DestinationController::class, 'detailDestination'])->name('destination.show');
Route::get('/tour-package/{slug}/book', [BookingController::class, 'showRegularForm'])->name('booking.regular.form');
Route::post('/booking/regular', [BookingController::class, 'bookingRegular'])->name('booking.regular.store');

Route::get('/custom-trip', [BookingController::class, 'showCustomForm'])->name('booking.custom');
Route::post('/booking/custom', [BookingController::class, 'bookingCustom'])->name('booking.custom.store');


// Auth-Admin
Route::middleware('guest')->group(function () {
    Route::get('/zundap', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/zundap', [AuthController::class, 'login'])->name('login.post');
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
    Route::delete('/manage-booking/bulk-destroy', [BookingController::class, 'bulkDestroy'])->name('manage-booking.bulk-destroy');
    Route::resource('/manage-booking', BookingController::class);

    // manage car
    Route::delete('/manage-car/bulk-destroy', [CarController::class, 'bulkDestroy'])->name('manage-car.bulk-destroy');
    Route::resource('/manage-car', CarController::class);

    // manage booking car
    Route::delete('manage-booking-car/bulk-destroy', [BookingCarController::class, 'bulkDestroy'])->name('manage-booking-car.bulk-destroy');
    Route::resource('/manage-booking-car', BookingCarController::class);
    
    // Manage Gallery
    Route::post('/manage-gallery/bulk-compress', [GalleriesController::class, 'bulkCompress'])->name('manage-gallery.bulk-compress');
    Route::delete('/manage-gallery/bulk-destroy', [GalleriesController::class, 'bulkDestroy'])->name('manage-gallery.bulk-destroy');
    Route::resource('/manage-gallery', GalleriesController::class);

    Route::delete('/manage-blog/bulk-destroy', [BlogController::class, 'bulkDestroy'])->name('manage-blog.bulk-destroy');
    Route::resource('/manage-blog', BlogController::class);

    // Manage Testimoni
    Route::post('/manage-testimonials/bulk-compress', [TestimoniController::class, 'bulkCompress'])->name('manage-testimonials.bulk-compress');
    Route::delete('/manage-testimonials/bulk-destroy', [TestimoniController::class, 'bulkDestroy'])->name('manage-testimonials.bulk-destroy');
    Route::resource('/manage-testimonials', TestimoniController::class);

    // Manage Destination
    Route::post('/manage-destination/bulk-compress', [DestinationController::class, 'bulkCompress'])->name('manage-destination.bulk-compress');
    Route::post('/manage-destination/{destination_id}/duplicate', [DestinationController::class, 'duplicate'])
        ->name('manage-destination.duplicate');
    Route::delete('/manage-destination/bulk-destroy', [DestinationController::class, 'bulkDestroy'])->name('manage-destination.bulk-destroy');
    Route::resource('/manage-destination', DestinationController::class);
});
