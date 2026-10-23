<?php

use Illuminate\Support\Facades\Route;
use Modules\Car\Http\Controllers\CarController;
use Modules\Car\Http\Controllers\VehicleController;
use Modules\Car\Http\Controllers\VehicleModelController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cars', CarController::class)->names('car');
    Route::resource('vehicle-models', VehicleModelController::class)->names('vehicle-model');
    Route::resource('vehicles', VehicleController::class)->names('vehicles');
});
