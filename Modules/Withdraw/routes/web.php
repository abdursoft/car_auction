<?php

use Illuminate\Support\Facades\Route;
use Modules\Withdraw\Http\Controllers\WithdrawController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('withdraws', WithdrawController::class)->names('withdraw');
});
