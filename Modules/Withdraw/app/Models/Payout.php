<?php

namespace Modules\Withdraw\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Withdraw\Database\Factories\PayoutFactory;

class Payout extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): PayoutFactory
    // {
    //     // return PayoutFactory::new();
    // }
}
