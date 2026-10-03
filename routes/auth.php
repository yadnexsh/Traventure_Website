<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('auth/google/redirect', [SocialiteController::class, 'redirect'])->name('google.redirect');
Route::get('auth/google/callback', [SocialiteController::class, 'callback'])->name('google.callback');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerificationController::class, 'verify'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
    Route::post('email/verification-notification', [VerificationController::class, 'send'])
                ->middleware('throttle:6,1')
                ->name('verification.send');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});
