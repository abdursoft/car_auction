<?php

namespace Modules\Car\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Models\Brand;
use Modules\Admin\Models\Category;
use Modules\Auction\Models\Auction;

class Vehicle extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'vin',
        'year',
        'trim',
        'brand_id',
        'vehicle_model_id',
        'category_id',
        'mileage',
        'engine_type',
        'transmission',
        'drivetrain',
        'exterior_color',
        'interior_color',
        'fuel_type',
        'vehicle_type',
        'condition',
        'has_keys',
        'engine_starts',
        'drivetrain_operational',
        'transmission_operational',
        'tire_condition',
        'frame_damage',
        'primary_damage',
        'secondary_damage',
        'loss_type',
        'title_status',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'mileage' => 'integer',
            'has_keys' => 'boolean',
            'engine_starts' => 'boolean',
            'drivetrain_operational' => 'boolean',
            'transmission_operational' => 'boolean',
            'frame_damage' => 'boolean',
        ];
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class, 'vehicle_id');
    }
}