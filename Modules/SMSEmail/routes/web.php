<?php

use Illuminate\Support\Facades\Route;
use Modules\SMSEmail\Http\Controllers\SMSEmailController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('smsemails', SMSEmailController::class)->names('smsemail');
});
