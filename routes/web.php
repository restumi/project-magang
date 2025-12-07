<?php

use App\Http\Controllers\HobbyController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// ===================== PAGE =====================
Route::get('/', function () {
    return view('layouts.app');
})->name('home');

// ===================== DASHBOARD =====================
// Route::get('/hobbies', [HobbyController::class, 'index'])->name('hobbies');
// Route::get('/students', [StudentController::class, 'index'])->name('students.index');


Route::get('/profile', function () {
    return 'profile';
})->name('profile');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/regist', function () {
    return view('auth.regist');
})->name('regist');


// ===================== HOBBY =====================
Route::resource('hobbies', HobbyController::class)->except('show', 'edit', 'create');

// ===================== STUDENTS =====================
Route::resource('students', StudentController::class)->except('show', 'edit', 'create');


