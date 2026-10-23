<?php

use Illuminate\Support\Facades\Route;
use Modules\Verification\Http\Controllers\VerificationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('verifications', VerificationController::class)->names('verification');
});
