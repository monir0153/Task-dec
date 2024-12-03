<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::user() ? redirect('/dashboard') : redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/auth', [AuthController::class, 'Authenticate'])->name('autheticate');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});
