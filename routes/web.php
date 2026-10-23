<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Web\Auth\WebAuthController;
use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
})->name('home');

Route::get('/auctions', function () {
    return inertia('auction/List');
})->name('auctions');

Route::get('/bidding', function () {
    return inertia('auction/Bidding');
})->name('bidding');

Route::get('/how-to-sell', function () {
    return inertia('HowToSell');
})->name('howToSell');

Route::get('/signin', function () {
    return inertia('auth/Signin');
})->name('login');

Route::get('/signup', function () {
    return inertia('auth/Signup');
})->name('register');


// auth routes 
Route::prefix('auth')->name('auth')->group(function () {
    Route::post('/login', [WebAuthController::class, 'login'])->name('login');
    Route::post('/register', [WebAuthController::class, 'create'])->name('register');
    Route::get('/logout', [WebAuthController::class, 'logout'])->name('logout');

    // google authentication 
    Route::get('/google', [SocialAuthController::class, 'redirectToGoogle'])
        ->name('google');
    Route::get('/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])
        ->name('google.callback');
});

// dashboard route for all authenticated users 
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [WebAuthController::class, 'dashboard'])->name('dashboard');
});

// seller, moderator and admin routes will be added here in the future 
Route::middleware(['role:admin|seller'])->group(function () {
    // Admin and Seller specific routes
    Route::get('/add-listing', [PageController::class, 'addListing'])->name('addListing');
    Route::post('/add-listing', [PageController::class, 'addListing'])->name('addListing.post');
});


// admin routes will be added here in the future 
Route::middleware(['role:admin'])->name('admin')->prefix('admin')->group(function () {

    // brands 
    Route::get('/brands', function () {
        return inertia('admin/brand/Index');
    })->name('brands.index');
});
