<?php

use App\Http\Controllers\HobbyController;
use Illuminate\Support\Facades\Route;

// ===================== PAGE =====================
Route::get('/', function () {
    return view('layouts.app');
})->name('home');

Route::get('/hobbies', [HobbyController::class, 'index'])->name('hobbies');

Route::get('/students', function () {
    return 'students';
})->name('students');

Route::get('/profile', function () {
    return 'profile';
})->name('profile');



