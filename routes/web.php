<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

// Protected routes for car listings
Route::middleware(['auth'])->group(function () {
    Route::get('/my-listings', [CarController::class, 'myListings'])->name('my-listings');
    Route::get('/create-listing', [CarController::class, 'create'])->name('create-listing');
    Route::post('/verify-license-plate', [CarController::class, 'verifyLicensePlate'])->name('verify-license-plate');
    Route::post('/listings', [CarController::class, 'store'])->name('listings.store');
    Route::delete('/listings/{car}', [CarController::class, 'destroy'])->name('listings.destroy');
});

