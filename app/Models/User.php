<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

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

    // Auctions created by this user
    // public function auctions()
    // {
    //     return $this->hasMany(Auction::class);
    // }

    // // Bids placed by this user
    // public function bids()
    // {
    //     return $this->hasMany(Bid::class);
    // }

    // // Auctions added to the user's watchlist
    // public function watchlist()
    // {
    //     return $this->belongsToMany(
    //         Auction::class,
    //         'watchlist'
    //     )->withTimestamps();
    // }

    // // Check whether the user is winning an auction
    // public function isWinning(Auction $auction): bool
    // {
    //     $highestBid = $auction->bids()
    //         ->orderByDesc('amount')
    //         ->first();

    //     return $highestBid !== null
    //         && (string) $highestBid->user_id === (string) $this->id;
    // }
}
