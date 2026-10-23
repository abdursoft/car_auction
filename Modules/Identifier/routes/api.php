<?php

use Illuminate\Support\Facades\Route;
use Modules\Identifier\Http\Controllers\IdentifierController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('identifiers', IdentifierController::class)->names('identifier');
});
