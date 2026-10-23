<?php

namespace Modules\Auction\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'auction_id',
        'user_id',
        'amount',
        'currency',
        'status',
        'bid_type',
        'placed_at',
        'rejected_at',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'placed_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAccepted($query)
    {
        return $query->whereIn('status', [
            'active',
            'winning',
            'outbid',
            'winning_bid',
        ]);
    }
}