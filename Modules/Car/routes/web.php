<?php

use Illuminate\Support\Facades\Route;
use Modules\Car\Http\Controllers\CarController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cars', CarController::class)->names('car');
});
