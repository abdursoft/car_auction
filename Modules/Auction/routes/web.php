<?php

use Illuminate\Support\Facades\Route;
use Modules\Auction\Http\Controllers\AuctionController;
use Modules\Auction\Http\Controllers\AuctionImageController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('auctions', AuctionController::class)->names('auction');
    Route::resource('auctions.images', AuctionImageController::class)
        ->parameters([
            'images' => 'auctionImage',
        ])->names('auction.images');
});
