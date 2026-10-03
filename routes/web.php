<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTrekController;

Route::get('/', [PublicTrekController::class, 'home'])->name('home');
Route::get('/treks', [PublicTrekController::class, 'index'])->name('treks.index');
Route::get('/treks/{trek:slug}', [PublicTrekController::class, 'show'])->name('treks.show');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
