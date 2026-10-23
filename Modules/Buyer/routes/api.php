<?php

use Illuminate\Support\Facades\Route;
use Modules\Buyer\Http\Controllers\BuyerController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('buyers', BuyerController::class)->names('buyer');
});
