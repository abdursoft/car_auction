<?php

namespace Modules\Car\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Car\Database\Factories\VehicleFactory;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): VehicleFactory
    // {
    //     // return VehicleFactory::new();
    // }
}
