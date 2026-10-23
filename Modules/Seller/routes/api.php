<?php

use Illuminate\Support\Facades\Route;
use Modules\Seller\Http\Controllers\SellerController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sellers', SellerController::class)->names('seller');
});
