<?php

namespace Modules\Seller\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Seller\Database\Factories\SellerVerificationFactory;

class SellerVerification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): SellerVerificationFactory
    // {
    //     // return SellerVerificationFactory::new();
    // }
}
