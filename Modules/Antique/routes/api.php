<?php

use Illuminate\Support\Facades\Route;
use Modules\Antique\Http\Controllers\AntiqueController;
use Modules\Antique\Http\Controllers\AntiqueMaterialController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('antiques', AntiqueController::class)->names('antique');
    Route::apiResource('antique-materials',AntiqueMaterialController::class)->names('antique-material');
});
