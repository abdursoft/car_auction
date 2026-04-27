<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'auction_date' => 'datetime',
        'additional_images' => 'array', // Automatically encodes/decodes JSON
        'is_buy_now' => 'integer',
        'starting_bid' => 'integer',
        'current_bid' => 'integer',
    ];

    // --- Relationships ---

    public function brand(): BelongsTo 
    { 
        return $this->belongsTo(Brand::class); 
    }

    public function vehicleModel(): BelongsTo 
    { 
        return $this->belongsTo(VehicleModel::class); 
    }

    public function category(): BelongsTo 
    { 
        return $this->belongsTo(Category::class); 
    }

    // public function bids(): HasMany 
    // { 
    //     return $this->hasMany(Bid::class); 
    // }

    // --- Accessors ---

    /**
     * Get a formatted display title.
     */
    public function getFullTitleAttribute(): string
    {
        return "{$this->year} {$this->brand?->name} {$this->vehicle_model?->name} {$this->trim}";
    }
}