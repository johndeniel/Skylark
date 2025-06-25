<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThoughtController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home route - shows landing page for guests, redirects authenticated users to thought page
Route::get('/', function () {
    return Auth::check() ? redirect()->route('thought') : view('welcome');
})->name('home');

// Guest-only routes - accessible only to unauthenticated users
Route::middleware('guest')->group(function () {
    // Sign in routes
    Route::get('/signin', [AuthController::class, 'signin'])->name('index.signin');
    Route::get('/login', [AuthController::class, 'signin'])->name('login');
    Route::post('/signin', [AuthController::class, 'authenticate'])->name('authenticate');
    
    // Sign up routes
    Route::get('/signup', [AuthController::class, 'signup'])->name('index.signup');
    Route::post('/signup', [AuthController::class, 'store'])->name('signup.store');
});

// Protected routes - accessible only to authenticated users
Route::middleware('auth')->group(function () {
    // Dashboard - main application landing page after login
    Route::get('/thought', [ThoughtController::class, 'index'])->name('thought');

    // Thought management routes
    Route::get('/thoughts', [ThoughtController::class, 'index'])->name('thoughts.index');
    Route::post('/thoughts', [ThoughtController::class, 'store'])->name('thoughts.store');
    Route::put('/thoughts/{thoughtId}', [ThoughtController::class, 'update'])->name('thoughts.update');
    Route::delete('/thoughts/{thoughtId}', [ThoughtController::class, 'destroy'])->name('thoughts.destroy');

    // Bookmark routes
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmark');
    Route::post('/bookmarks/toggle/{thoughtId}', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');

    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload-photo');
    
    // Authentication - logout functionality
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});