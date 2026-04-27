<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'logo', 'description', 'website_url', 'is_featured'];

    /**
     * Auto-slugging logic
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(fn($brand) => $brand->slug = $brand->slug ?? Str::slug($brand->name));
    }
}
