<?php

namespace Modules\Wallet\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Payment\Models\Payment;
use Modules\Withdraw\Models\Payout;

class WalletTransaction extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'wallet_id',
        'sender_wallet_id',
        'receiver_wallet_id',
        'payout_id',
        'payment_id',
        'transaction_number',
        'type',
        'direction',
        'amount',
        'currency',
        'balance_before',
        'balance_after',
        'transaction_fee',
        'status',
        'reference',
        'description',
        'metadata',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'balance_before' => 'decimal:2',
            'balance_after' => 'decimal:2',
            'transaction_fee' => 'decimal:2',
            'metadata' => 'array',
            'completed_at' => 'datetime',
        ];
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function senderWallet(): BelongsTo
    {
        return $this->belongsTo(
            Wallet::class,
            'sender_wallet_id'
        );
    }

    public function receiverWallet(): BelongsTo
    {
        return $this->belongsTo(
            Wallet::class,
            'receiver_wallet_id'
        );
    }

    public function payout(): BelongsTo
    {
        return $this->belongsTo(Payout::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}