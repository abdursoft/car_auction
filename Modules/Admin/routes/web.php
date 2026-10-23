<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\BrandController;
use Modules\Admin\Http\Controllers\CategoryController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('admins', AdminController::class)->names('admin');
    Route::apiResource('brands', BrandController::class)->names('brand');
    Route::apiResource('categories', CategoryController::class)->names('category');
});
