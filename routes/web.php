<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\HomeController;

use Illuminate\Support\Facades\Route;

// User-Route
Route::resource('/', HomeController::class);

// Admin Route
Route::resource('/manage-user', UserController::class);
Route::delete('/manage-user/bulk-destroy', [UserController::class, 'bulkDestroy'])->name('manage-user.bulk-destroy');
