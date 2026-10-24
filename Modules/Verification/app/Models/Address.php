<?php

namespace Modules\Verification\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'address_type',
        'recipient_name',
        'company_name',
        'phone_number',
        'address_line_1',
        'address_line_2',
        'district',
        'city',
        'state_province',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'is_default_shipping',
        'is_default_billing',
        'delivery_instructions',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_default_shipping' => 'boolean',
            'is_default_billing' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}