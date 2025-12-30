<?php

use App\Classes\apiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HobbyController;
use App\Http\Controllers\Api\StudentController;

Route::get('/test', function(){
    return apiResponse::success();
});

// Hobbies
Route::get('/hobbies', [HobbyController::class, 'index']);
Route::post('/hobbies', [HobbyController::class, 'store']);
Route::put('/hobbies/{hobby}', [HobbyController::class, 'update']);
Route::delete('/hobbies/{hobby}', [HobbyController::class, 'destroy']);

// Students
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{student}', [StudentController::class, 'update']);
Route::delete('/students/{student}', [StudentController::class, 'destroy']);
