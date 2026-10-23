<?php

namespace Modules\Auction\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionResult extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'auction_id',
        'winning_user_id',
        'winning_bid_id',
        'result',
        'final_price',
        'currency',
        'finalized_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'final_price' => 'decimal:2',
            'finalized_at' => 'datetime',
        ];
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function winningUser()
    {
        return $this->belongsTo(User::class, 'winning_user_id');
    }

    public function winningBid()
    {
        return $this->belongsTo(Bid::class, 'winning_bid_id');
    }
}
