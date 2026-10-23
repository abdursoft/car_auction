<?php

namespace Modules\Auction\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Auction\Database\Factories\BidFactory;

class Bid extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): BidFactory
    // {
    //     // return BidFactory::new();
    // }
}
