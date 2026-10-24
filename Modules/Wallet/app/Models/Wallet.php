<?php

namespace Modules\Wallet\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'user_id',
        'wallet_number',
        'wallet_type',
        'currency',
        'balance',
        'available_balance',
        'pending_balance',
        'reserved_balance',
        'withdrawn_balance',
        'status',
        'is_primary',
        'last_transaction_at',
        'freeze_reason',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
            'available_balance' => 'decimal:2',
            'pending_balance' => 'decimal:2',
            'reserved_balance' => 'decimal:2',
            'withdrawn_balance' => 'decimal:2',
            'is_primary' => 'boolean',
            'last_transaction_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOfCurrency($query, string $currency)
    {
        return $query->where('currency', strtoupper($currency));
    }
}