<?php

use Illuminate\Support\Facades\Route;
use Modules\Installation\Http\Controllers\InstallationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('installations', InstallationController::class)->names('installation');
});
