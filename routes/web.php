<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Landing page route - publicly accessible
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Guest-only routes - accessible only to unauthenticated users
Route::middleware('guest')->group(function () {
    // Sign in routes
    Route::get('/signin', [AuthController::class, 'signin'])->name('index.signin');        // Display login form
    Route::post('/signin', [AuthController::class, 'authenticate'])->name('authenticate'); // Process login attempt
    
    // Sign up routes
    Route::get('/signup', [AuthController::class, 'signup'])->name('index.signup');         // Display registration form
    Route::post('/signup', [AuthController::class, 'store'])->name('signup.store');         // Process new user registration
});

// Protected routes - accessible only to authenticated users
Route::middleware('auth')->group(function () {
    // Dashboard - main application landing page after login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');            // Display user profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');    // Update user profile
    
    // Authentication - logout functionality
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');               // Process user logout
});