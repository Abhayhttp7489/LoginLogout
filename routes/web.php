<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Home route for authenticated users
Route::middleware('auth')->group(function () {
    Route::view('/', 'welcome')->name('home');

    // Logout routes
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('logout', [AuthController::class, 'logoutPost'])->name('logout.post');

    // Route for the dashboard page
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route for editing profile
    Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('edit.profile');

    // Route for updating profile
    Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');
});

// Public routes for guest users
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

    // Registration routes
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerPost'])->name('register.post');
});
