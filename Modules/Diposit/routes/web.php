<?php

use Illuminate\Support\Facades\Route;
use Modules\Diposit\Http\Controllers\DipositController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('diposits', DipositController::class)->names('diposit');
});
