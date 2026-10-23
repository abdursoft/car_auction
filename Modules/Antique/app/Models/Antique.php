<?php

namespace Modules\Antique\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Auction\Models\Auction;

class Antique extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'title',
        'maker',
        'estimated_year',
        'material',
        'provenance',
        'condition_description',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'estimated_year' => 'integer',
        ];
    }

    /**
     * Materials associated with this antique.
     */
    public function materials()
    {
        return $this->belongsToMany(
            AntiqueMaterial::class,
            'antique_antique_material',
            'antique_id',
            'antique_material_id'
        )->withTimestamps();
    }

    /**
     * Auctions associated with this antique.
     */
    public function auctions()
    {
        return $this->hasMany(Auction::class, 'antique_id');
    }
}