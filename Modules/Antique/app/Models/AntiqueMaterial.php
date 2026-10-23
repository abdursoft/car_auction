<?php

namespace Modules\Antique\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Antique\Database\Factories\AntiqueMaterialFactory;

class AntiqueMaterial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): AntiqueMaterialFactory
    // {
    //     // return AntiqueMaterialFactory::new();
    // }
}
