<?php

use Illuminate\Support\Facades\Route;
use Modules\Identifier\Http\Controllers\IdentifierController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('identifiers', IdentifierController::class)->names('identifier');
});
