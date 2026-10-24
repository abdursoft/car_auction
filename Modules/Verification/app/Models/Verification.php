<?php

namespace Modules\Verification\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Verification extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'user_id',
        'verification_type',
        'status',
        'legal_first_name',
        'legal_middle_name',
        'legal_last_name',
        'country_of_residence',
        'nationality',
        'document_type',
        'issuing_country',
        'document_number_encrypted',
        'document_expiry_date',
        'reviewed_by',
        'submitted_at',
        'reviewed_at',
        'verified_at',
        'expires_at',
        'rejection_reason',
        'internal_notes',
        'provider_response',
    ];

    protected function casts(): array
    {
        return [
            // Laravel automatically encrypts on write and decrypts on read.
            'document_number_encrypted' => 'encrypted',
            'document_expiry_date' => 'date',
            'submitted_at' => 'datetime',
            'reviewed_at' => 'datetime',
            'verified_at' => 'datetime',
            'expires_at' => 'datetime',
            'provider_response' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'reviewed_by'
        );
    }

    public function documents(): HasMany
    {
        return $this->hasMany(VerificationDocument::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', [
            'pending',
            'submitted',
            'under_review',
        ]);
    }
}
