<?php

namespace Modules\Verification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Verification\Database\Factories\VerificationFactory;

class Verification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): VerificationFactory
    // {
    //     // return VerificationFactory::new();
    // }
}
