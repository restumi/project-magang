<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Social\CommentController;
use App\Http\Controllers\Social\PostController;
use App\Http\Controllers\Social\VideoController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VerifyEmailController;
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

    // ===================== VERIFY EMAIL =====================
    Route::get('/email/verify', [VerifyEmailController::class, 'showVerify'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyRequest'])->name('verification.verify');
    Route::post('/email/verification/resend', [VerifyEmailController::class, 'reSend'])->middleware('throttle:6,1')->name('verification.resend');

    // ===================== SOCIAL =====================
    Route::resource('posts', PostController::class)->except(['show']);
    Route::resource('videos', VideoController::class);
    // ===================== COMMENT =====================
    Route::post('/posts/{post}/comments', [CommentController::class, 'storePostComment'])->name('posts.comments.store');
    Route::post('/videos/{video}/comments', [CommentController::class, 'storeVideoComment'])->name('videos.comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'updateComment'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'deleteComment'])->name('comments.destroy');

    // ===================== PROFILE =====================
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // job processing
    Route::post('/send-maintance-info', [MailController::class, 'sendEmails'])->name('test.bulk.email');

    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



