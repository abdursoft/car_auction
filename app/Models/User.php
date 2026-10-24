<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

// Module models
use Modules\Buyer\Models\BuyerProfile;
use Modules\Auction\Models\Auction;
use Modules\Auction\Models\Bid;
use Modules\Auction\Models\Watchlist;
use Modules\Payment\Models\Payment;
use Modules\Review\Models\Review;
use Modules\Shipping\Models\ShippingOrder;
use Modules\Wallet\Models\Wallet;
use Modules\Verification\Models\Address;
use Modules\Verification\Models\Verification;
use Modules\Verification\Models\VerificationDocument;
use Modules\Withdraw\Models\Payout;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'bio',
        'location',
        'country',
        'city',
        'state',
        'postal_code',
        'balance',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_verified' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Buyer Module
    |--------------------------------------------------------------------------
    */

    public function buyerProfile(): HasOne
    {
        return $this->hasOne(BuyerProfile::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(VerificationDocument::class);
    }

    public function verification(): HasMany
    {
        return $this->hasMany(Verification::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Auction Module
    |--------------------------------------------------------------------------
    */

    public function auctions(): HasMany
    {
        return $this->hasMany(Auction::class);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    public function watchlist(): HasMany
    {
        return $this->hasMany(Watchlist::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Payment Module
    |--------------------------------------------------------------------------
    */

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Wallet Module
    |--------------------------------------------------------------------------
    */

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Review Module
    |--------------------------------------------------------------------------
    */

    public function writtenReviews(): HasMany
    {
        return $this->hasMany(
            Review::class,
            'reviewer_id'
        );
    }

    public function receivedReviews(): HasMany
    {
        return $this->hasMany(
            Review::class,
            'reviewed_user_id'
        );
    }

    public function reviewedVerifications(): HasMany
    {
        return $this->hasMany(
            Verification::class,
            'reviewed_by'
        );
    }

    public function purchasedShippingOrders(): HasMany
    {
        return $this->hasMany(ShippingOrder::class, 'buyer_id');
    }

    public function soldShippingOrders(): HasMany
    {
        return $this->hasMany(ShippingOrder::class, 'seller_id');
    }
}
