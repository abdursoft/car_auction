<?php

namespace Modules\Buyer\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyerProfile extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'display_name',
        'profile_photo',
        'date_of_birth',
        'gender',
        'phone_number',
        'alternate_phone_number',
        'preferred_language',
        'timezone',
        'buyer_type',
        'company_name',
        'business_registration_number',
        'tax_identification_number',
        'preferred_currency',
        'email_notifications',
        'sms_notifications',
        'marketing_notifications',
        'profile_completed',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'marketing_notifications' => 'boolean',
            'profile_completed' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}