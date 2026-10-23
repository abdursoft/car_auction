<?php

use Illuminate\Support\Facades\Route;
use Modules\SMSEmail\Http\Controllers\SMSEmailController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('smsemails', SMSEmailController::class)->names('smsemail');
});
