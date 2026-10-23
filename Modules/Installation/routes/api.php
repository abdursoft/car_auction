<?php

use Illuminate\Support\Facades\Route;
use Modules\Installation\Http\Controllers\InstallationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('installations', InstallationController::class)->names('installation');
});
