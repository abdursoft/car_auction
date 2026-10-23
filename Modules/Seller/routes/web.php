<?php

use Illuminate\Support\Facades\Route;
use Modules\Seller\Http\Controllers\SellerController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sellers', SellerController::class)->names('seller');
});
