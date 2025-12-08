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



