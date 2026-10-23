<?php

use Illuminate\Support\Facades\Route;
use Modules\Auction\Http\Controllers\AuctionController;
use Modules\Auction\Http\Controllers\AuctionImageController;
use Modules\Auction\Http\Controllers\AuctionResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('auctions', AuctionController::class)->names('auction');
    Route::apiResource('auctions.images', AuctionImageController::class)
    ->parameters([
        'images' => 'auctionImage',
    ])->names('auction.images');
    Route::apiResource('auction-results', AuctionResultController::class)->names('auction.results');
});
