<?php

namespace Modules\Buyer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Buyer\Database\Factories\BuyerProfileFactory;

class BuyerProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): BuyerProfileFactory
    // {
    //     // return BuyerProfileFactory::new();
    // }
}
