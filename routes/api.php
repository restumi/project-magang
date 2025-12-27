<?php

use App\Classes\apiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HobbyController;

Route::get('/test', function(){
    return apiResponse::success();
});

Route::get('/hobbies', [HobbyController::class, 'index']);
Route::post('/hobbies', [HobbyController::class, 'store']);
Route::put('/hobbies/{hobby}', [HobbyController::class, 'update']);
Route::delete('/hobbies/{hobby}', [HobbyController::class, 'destroy']);
