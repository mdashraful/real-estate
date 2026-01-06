<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::group(['as' => 'front.'], function () {
    Route::get('/', [FrontController::class, 'home'])->name('home');
    Route::get('/about', [FrontController::class, 'about'])->name('about');
});

// Guest Routes (for non-authenticated users)
Route::middleware('guest')->group(function () {
    // User Authentication
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Admin Authentication
    Route::prefix('admin')->group(function() {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'login']);
    });
});

// Authenticated User Routes
Route::middleware(['auth', 'user'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // User Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Add more admin routes here
});