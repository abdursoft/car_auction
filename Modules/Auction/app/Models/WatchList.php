<?php

namespace Modules\Auction\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Auction\Database\Factories\WatchListFactory;

class WatchList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): WatchListFactory
    // {
    //     // return WatchListFactory::new();
    // }
}
