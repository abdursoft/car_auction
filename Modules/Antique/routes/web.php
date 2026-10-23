<?php

use Illuminate\Support\Facades\Route;
use Modules\Antique\Http\Controllers\AntiqueController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('antiques', AntiqueController::class)->names('antique');
});
