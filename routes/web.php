<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InteractionController;



// Redirect users to login if they're not authenticated, or to the dashboard if they are
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Dashboard route using Inertia with Vue
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated routes for profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Registration routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

// Manajemen Kontak (Customers Resource routes)
Route::resource('customers', CustomerController::class)
    ->middleware(['auth', 'verified']);

// Interactions
Route::middleware(['auth'])->group(function () {
    // Show interactions
    Route::get('/interactions', [InteractionController::class, 'index'])->name('interactions.index');
    
    // Add new interaction
    Route::post('/interactions', [InteractionController::class, 'store']);
    
    // Edit interaction
    Route::get('/interactions/{interaction}/edit', [InteractionController::class, 'edit'])->name('interactions.edit');
    Route::put('/interactions/{interaction}', [InteractionController::class, 'update']);
    
    // Delete interaction
    Route::delete('/interactions/{interaction}', [InteractionController::class, 'destroy']);
});
// Include additional authentication routes (like registration, password resets, etc.)
require __DIR__.'/auth.php';
