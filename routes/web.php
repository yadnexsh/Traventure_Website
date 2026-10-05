<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTrekController;

Route::get('/', [PublicTrekController::class, 'home'])->name('home');
Route::get('/treks', [PublicTrekController::class, 'index'])->name('treks.index');
Route::get('/treks/{trek:slug}', [PublicTrekController::class, 'show'])->name('treks.show');

Route::get('/departures/{departure}/interest', [\App\Http\Controllers\ExpressionOfInterestController::class, 'create'])->name('interest.create');
Route::post('/departures/{departure}/interest', [\App\Http\Controllers\ExpressionOfInterestController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('interest.store');

Route::middleware(['auth', 'admin_or_staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('treks', \App\Http\Controllers\Admin\TrekController::class)->middleware('is_admin');
    
    Route::get('departures', [\App\Http\Controllers\Admin\DepartureController::class, 'index'])->name('departures.index');
    Route::get('departures/{departure}', [\App\Http\Controllers\Admin\DepartureController::class, 'show'])->name('departures.show');
    // Group the admin-only departure methods (create, store, edit, update, destroy)
    Route::middleware('is_admin')->group(function () {
        Route::resource('departures', \App\Http\Controllers\Admin\DepartureController::class)->except(['index', 'show']);
    });

    Route::get('departures/{departure}/interest', [\App\Http\Controllers\Admin\ExpressionOfInterestController::class, 'index'])->name('departures.interest');
    Route::resource('reservations', \App\Http\Controllers\Admin\ReservationController::class)->only(['index', 'show', 'create', 'store']);
    Route::post('seat-allocations/{seatAllocation}/release', [\App\Http\Controllers\Admin\SeatAllocationController::class, 'release'])->name('seat-allocations.release');
});

require __DIR__.'/auth.php';
