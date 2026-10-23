<?php

use Illuminate\Support\Facades\Route;
use Modules\Car\Http\Controllers\CarController;
use Modules\Car\Http\Controllers\VehicleController;
use Modules\Car\Http\Controllers\VehicleModelController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('cars', CarController::class)->names('car');
    Route::apiResource('vehicle-models', VehicleModelController::class)->names('vehicle-model');
    Route::apiResource('vehicles', VehicleController::class)->names('vehicles');
});
