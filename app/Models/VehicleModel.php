<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VehicleModel extends Model
{
    protected $fillable = ['brand_id', 'name', 'slug', 'category_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($model) => $model->slug = Str::slug($model->name));
    }
}
