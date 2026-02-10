<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;




Route::get('/test', function () {
    return 'Laravel is working';
});

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Manage listings (MUST be before {listing})
Route::get('/listings/manage', [ListingController::class, 'manage'])
    ->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])
    ->middleware('auth');

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])
    ->middleware('auth');

// Show Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
    ->middleware('auth');

// Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])
    ->middleware('auth');

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
    ->middleware('auth');

// Show register form
Route::get('/register', [UserController::class, 'create'])
    ->middleware('guest');

// Create new user
Route::post('/users', [UserController::class, 'store']);

// Show login form
Route::get('/login', [UserController::class, 'login'])
    ->name('login')
    ->middleware('guest');

// Authenticate user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Log user out
Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth');
