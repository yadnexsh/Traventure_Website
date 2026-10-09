<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTrekController;

Route::get('/', [PublicTrekController::class, 'home'])->name('home');
Route::get('/treks', [PublicTrekController::class, 'index'])->name('treks.index');
Route::get('/treks/region/{region}', [PublicTrekController::class, 'index'])->name('treks.region');
Route::get('/treks/{trek:slug}', [PublicTrekController::class, 'show'])->name('treks.show');
Route::get('/about', [PublicTrekController::class, 'about'])->name('about');

Route::get('/departures/{departure}/interest', [\App\Http\Controllers\ExpressionOfInterestController::class, 'create'])->name('interest.create');
Route::post('/departures/{departure}/interest', [\App\Http\Controllers\ExpressionOfInterestController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('interest.store');

Route::middleware(['auth', 'verified'])->prefix('booking')->name('booking.')->group(function () {
    Route::get('/{departure}', [\App\Http\Controllers\BookingController::class, 'details'])->name('details');
    Route::post('/{departure}/hold', [\App\Http\Controllers\BookingController::class, 'createHold'])->name('hold');
    
    // Trekmates
    Route::get('/{allocation}/trekmates', [\App\Http\Controllers\BookingController::class, 'trekmates'])->name('trekmates');
    Route::post('/{allocation}/trekmates', [\App\Http\Controllers\BookingController::class, 'storeTrekmates'])->name('trekmates.store');
    
    // Add-ons
    Route::get('/{allocation}/addons', [\App\Http\Controllers\BookingController::class, 'addons'])->name('addons');
    Route::post('/{allocation}/addons', [\App\Http\Controllers\BookingController::class, 'storeAddons'])->name('addons.store');
    
    // Review
    Route::get('/{allocation}/review', [\App\Http\Controllers\BookingController::class, 'review'])->name('review');
    Route::post('/{allocation}/confirm', [\App\Http\Controllers\BookingController::class, 'confirm'])->name('confirm'); // Placeholder for payment
    
    // Payment (Placeholder)
    Route::get('/{allocation}/payment', [\App\Http\Controllers\BookingController::class, 'payment'])->name('payment');
    Route::post('/{allocation}/payment', [\App\Http\Controllers\BookingController::class, 'processPayment'])->name('payment.process');
    
    // Confirmation
    Route::get('/{allocation}/confirmation', [\App\Http\Controllers\BookingController::class, 'confirmation'])->name('confirmation');
});

Route::middleware(['auth', 'verified'])->prefix('account')->name('account.')->group(function () {
    Route::get('/', [\App\Http\Controllers\CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\CustomerController::class, 'profile'])->name('profile');
    Route::put('/profile', [\App\Http\Controllers\CustomerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/security', [\App\Http\Controllers\CustomerController::class, 'security'])->name('security');
    Route::put('/security', [\App\Http\Controllers\CustomerController::class, 'updateSecurity'])->name('security.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-trips', [\App\Http\Controllers\CustomerController::class, 'myTrips'])->name('customer.trips');
    Route::get('/my-trips/{reservation}', [\App\Http\Controllers\CustomerController::class, 'showTrip'])->name('customer.trip.show');
});

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


// Journal Routes
Route::get('/journal', [\App\Http\Controllers\JournalController::class, 'index'])->name('journal.index');
Route::get('/journal/{slug}', [\App\Http\Controllers\JournalController::class, 'show'])->name('journal.show');

require __DIR__.'/auth.php';
