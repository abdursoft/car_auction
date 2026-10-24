<?php

namespace Modules\Shipping\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Auction\Models\Auction;

class ShippingOrder extends Model
{
    use HasUuids;

    protected $fillable = [
        'auction_id',
        'buyer_id',
        'seller_id',
        'shipping_method_id',
        'delivery_method',
        'shipping_method_name',
        'carrier',
        'service_code',
        'tracking_number',
        'tracking_url',
        'recipient_address',
        'pickup_details',
        'shipping_cost',
        'currency',
        'shipped_at',
        'estimated_delivery_at',
        'delivered_at',
        'picked_up_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'recipient_address' => 'array',
            'pickup_details' => 'array',
            'shipping_cost' => 'decimal:2',
            'shipped_at' => 'datetime',
            'estimated_delivery_at' => 'datetime',
            'delivered_at' => 'datetime',
            'picked_up_at' => 'datetime',
        ];
    }

    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function shippingMethod(): BelongsTo
    {
        return $this->belongsTo(ShippingMethod::class);
    }
}