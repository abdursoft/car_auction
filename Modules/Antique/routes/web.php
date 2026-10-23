<?php

use Illuminate\Support\Facades\Route;
use Modules\Antique\Http\Controllers\AntiqueController;
use Modules\Antique\Http\Controllers\AntiqueMaterialController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('antiques', AntiqueController::class)->names('antique');
    Route::resource('antique-materials',AntiqueMaterialController::class)->names('antique-material');
});
