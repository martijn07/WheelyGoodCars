<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/cars', function () {
    return view('cars');
})->name('cars');

Route::get('/my-listings', function () {
    return view('my-listings');
})->name('my-listings');

Route::get('/create-listing', function () {
    return view('create-listing');
})->name('create-listing');

Route::post('/listings', function () {
    // Handle form submission here
    return redirect()->route('my-listings');
})->name('listings.store');
