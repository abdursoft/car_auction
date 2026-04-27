<?php

use App\Http\Controllers\Api\Auth\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// auth routes 
Route::post('/v1/login', [ApiAuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/v1/logout', [ApiAuthController::class, 'logout']);
});