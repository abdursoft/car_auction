<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // For Mobile API
use Spatie\Permission\Traits\HasRoles; // For Admin/Seller/Buyer Roles

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     * Including custom fields for a premium profile.
     */
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
        'is_verified', // Custom flag for internal trust
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Crucial for API responses.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_verified' => 'boolean',
    ];

    // --- Relationships ---

    // /**
    //  * Auctions created by this user (if they are a Seller/Admin)
    //  */
    // public function auctions()
    // {
    //     return $this->hasMany(Auction::class);
    // }

    // /**
    //  * Bids placed by this user
    //  */
    // public function bids()
    // {
    //     return $this->hasMany(Bid::class);
    // }

    // /**
    //  * Items on the user's watchlist
    //  */
    // public function watchlist()
    // {
    //     return $this->belongsToMany(Auction::class, 'watchlist')->withTimestamps();
    // }

    // // --- Helpers ---

    // /**
    //  * A quick check to see if the user is currently "winning" an auction
    //  */
    // public function isWinning(Auction $auction)
    // {
    //     $highestBid = $auction->bids()->latest()->first();
    //     return $highestBid && $highestBid->user_id === $this->id;
    // }
}