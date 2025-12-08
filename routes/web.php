<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// ===================== AUTH =====================
// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// regist
Route::get('/register', [AuthController::class, 'showRegist'])->name('register');
Route::post('/register', [AuthController::class, 'regist']);

// forgot password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

// reset password
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


Route::middleware('auth')->group(function(){
    Route::get('/', [HobbyController::class, 'index'])->name('home');

    // ===================== HOBBY =====================
    Route::resource('hobbies', HobbyController::class)->except('show', 'edit', 'create');

    // ===================== STUDENTS =====================
    Route::resource('students', StudentController::class)->except('show', 'edit', 'create');

    // profile
    Route::get('/profile', function () {
        return 'profile';
    })->name('profile');

    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



