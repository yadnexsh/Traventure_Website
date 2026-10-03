<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicTrekController;

Route::get('/', [PublicTrekController::class, 'home'])->name('home');
Route::get('/treks', [PublicTrekController::class, 'index'])->name('treks.index');
Route::get('/treks/{trek:slug}', [PublicTrekController::class, 'show'])->name('treks.show');
