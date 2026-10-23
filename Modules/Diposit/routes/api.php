<?php

use Illuminate\Support\Facades\Route;
use Modules\Diposit\Http\Controllers\DipositController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('diposits', DipositController::class)->names('diposit');
});
