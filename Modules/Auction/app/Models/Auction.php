<?php

namespace Modules\Auction\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Antique\Models\Antique;
use Modules\Car\Models\Vehicle;
use Modules\Payment\Models\Payment;
use Modules\Shipping\Models\ShippingOrder;

class Auction extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'listing_type',
        'vehicle_id',
        'antique_id',
        'user_id',
        'stock_number',
        'lot_number',
        'location',
        'location_branch',
        'starting_bid',
        'current_bid',
        'reserve_price',
        'buy_now_enabled',
        'buy_now_price',
        'currency',
        'auction_type',
        'starts_at',
        'ends_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'starting_bid' => 'decimal:2',
            'current_bid' => 'decimal:2',
            'reserve_price' => 'decimal:2',
            'buy_now_price' => 'decimal:2',
            'buy_now_enabled' => 'boolean',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function antique()
    {
        return $this->belongsTo(Antique::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function images()
    {
        return $this->hasMany(AuctionImage::class)->orderBy('sort_order');
    }

    public function result()
    {
        return $this->hasOne(AuctionResult::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function shippingOrders()
    {
        return $this->hasMany(ShippingOrder::class);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['upcoming', 'live']);
    }
}
