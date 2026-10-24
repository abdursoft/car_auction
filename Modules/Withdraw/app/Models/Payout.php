<?php

namespace Modules\Withdraw\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Auction\Models\Auction;
use Modules\Payment\Models\Payment;
use Modules\Wallet\Models\WalletTransaction;

class Payout extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'user_id',
        'auction_id',
        'payment_id',
        'payout_number',
        'payout_type',
        'currency',
        'requested_amount',
        'processing_fee',
        'tax_amount',
        'net_amount',
        'payout_method',
        'recipient_name',
        'recipient_email',
        'recipient_phone',
        'destination_country',
        'bank_name',
        'bank_account_holder',
        'bank_account_last4',
        'bank_routing_last4',
        'bank_account_token',
        'mobile_money_provider',
        'mobile_money_number_last4',
        'provider_account_id',
        'bank_country',
        'bank_currency',
        'swift_bic',
        'iban_last4',
        'intermediary_bank_reference',
        'exchange_rate',
        'settlement_currency',
        'settlement_amount',
        'international_transfer_fee',
        'status',
        'provider_name',
        'provider_payout_id',
        'provider_transaction_id',
        'provider_response',
        'reviewed_by',
        'processed_by',
        'requested_at',
        'reviewed_at',
        'processed_at',
        'paid_at',
        'failed_at',
        'cancelled_at',
        'failure_code',
        'failure_reason',
        'rejection_reason',
        'cancellation_reason',
        'reversal_reference',
        'reversed_at',
        'reference_number',
        'admin_notes',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'requested_amount' => 'decimal:2',
            'processing_fee' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'net_amount' => 'decimal:2',
            'international_transfer_fee' => 'decimal:2',
            'exchange_rate' => 'decimal:8',
            'settlement_amount' => 'decimal:2',
            'metadata' => 'array',
            'requested_at' => 'datetime',
            'reviewed_at' => 'datetime',
            'processed_at' => 'datetime',
            'paid_at' => 'datetime',
            'failed_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'reversed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'reviewed_by'
        );
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'processed_by'
        );
    }

    public function walletTransactions()
    {
        return $this->hasMany(
            WalletTransaction::class,
            'payout_id'
        );
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }
}