<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'front.'], function () {
    Route::get('/', [FrontController::class, 'home'])->name('home');
    Route::get('/about', [FrontController::class, 'about'])->name('about');
});

Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
Route::get('/login', [SessionController::class, 'create'])->name('login');
