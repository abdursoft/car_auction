<?php

use Illuminate\Support\Facades\Route;
use Modules\Buyer\Http\Controllers\BuyerController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('buyers', BuyerController::class)->names('buyer');
});
