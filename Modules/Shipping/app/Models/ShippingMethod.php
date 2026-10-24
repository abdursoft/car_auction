<?php

namespace Modules\Shipping\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingMethod extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'provider_name',
        'method_type',
        'description',
        'service_code',

        'supports_domestic',
        'supports_international',
        'supported_countries',
        'excluded_countries',
        'supported_regions',
        'supported_postal_codes',

        'supports_vehicles',
        'supports_antiques',
        'supports_fragile_items',
        'supports_hazardous_items',
        'supports_insured_shipments',
        'supports_tracking',
        'supports_pickup',
        'supports_door_delivery',

        'min_weight_kg',
        'max_weight_kg',
        'max_length_cm',
        'max_width_cm',
        'max_height_cm',
        'max_declared_value',

        'currency',
        'base_price',
        'price_per_kg',
        'price_per_km',
        'fuel_surcharge_percent',
        'insurance_rate_percent',
        'remote_area_surcharge',
        'customs_handling_fee',
        'minimum_charge',
        'requires_quote',

        'estimated_days_min',
        'estimated_days_max',
        'processing_days',
        'supports_scheduled_delivery',
        'supports_weekend_delivery',

        'requires_customs_declaration',
        'supports_duties_paid_delivery',
        'supports_duties_unpaid_delivery',
        'supports_import_export_documents',
        'supports_customs_brokerage',
        'required_customs_documents',
        'restricted_item_categories',
        'default_incoterm',

        'requires_sender_address',
        'requires_recipient_address',
        'requires_phone_number',
        'requires_signature',
        'requires_identity_check',
        'supports_address_validation',

        'insurance_available',
        'insurance_minimum_fee',
        'insurance_maximum_coverage',
        'claim_deadline_days',

        'tracking_url_template',
        'api_provider',
        'supports_label_generation',
        'supports_rate_calculation_api',
        'supports_tracking_api',

        'is_active',
        'sort_order',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            // Coverage configuration
            'supported_countries' => 'array',
            'excluded_countries' => 'array',
            'supported_regions' => 'array',
            'supported_postal_codes' => 'array',
            'required_customs_documents' => 'array',
            'restricted_item_categories' => 'array',
            'metadata' => 'array',

            // Boolean capabilities
            'supports_domestic' => 'boolean',
            'supports_international' => 'boolean',
            'supports_vehicles' => 'boolean',
            'supports_antiques' => 'boolean',
            'supports_fragile_items' => 'boolean',
            'supports_hazardous_items' => 'boolean',
            'supports_insured_shipments' => 'boolean',
            'supports_tracking' => 'boolean',
            'supports_pickup' => 'boolean',
            'supports_door_delivery' => 'boolean',
            'requires_quote' => 'boolean',
            'supports_scheduled_delivery' => 'boolean',
            'supports_weekend_delivery' => 'boolean',
            'requires_customs_declaration' => 'boolean',
            'supports_duties_paid_delivery' => 'boolean',
            'supports_duties_unpaid_delivery' => 'boolean',
            'supports_import_export_documents' => 'boolean',
            'supports_customs_brokerage' => 'boolean',
            'requires_sender_address' => 'boolean',
            'requires_recipient_address' => 'boolean',
            'requires_phone_number' => 'boolean',
            'requires_signature' => 'boolean',
            'requires_identity_check' => 'boolean',
            'supports_address_validation' => 'boolean',
            'insurance_available' => 'boolean',
            'supports_label_generation' => 'boolean',
            'supports_rate_calculation_api' => 'boolean',
            'supports_tracking_api' => 'boolean',
            'is_active' => 'boolean',

            // Decimal values
            'min_weight_kg' => 'decimal:3',
            'max_weight_kg' => 'decimal:3',
            'max_length_cm' => 'decimal:2',
            'max_width_cm' => 'decimal:2',
            'max_height_cm' => 'decimal:2',
            'max_declared_value' => 'decimal:2',
            'base_price' => 'decimal:2',
            'price_per_kg' => 'decimal:2',
            'price_per_km' => 'decimal:2',
            'fuel_surcharge_percent' => 'decimal:3',
            'insurance_rate_percent' => 'decimal:3',
            'remote_area_surcharge' => 'decimal:2',
            'customs_handling_fee' => 'decimal:2',
            'minimum_charge' => 'decimal:2',
            'insurance_minimum_fee' => 'decimal:2',
            'insurance_maximum_coverage' => 'decimal:2',

            'estimated_days_min' => 'integer',
            'estimated_days_max' => 'integer',
            'processing_days' => 'integer',
            'claim_deadline_days' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForVehicles($query)
    {
        return $query->where('supports_vehicles', true);
    }

    public function scopeForAntiques($query)
    {
        return $query->where('supports_antiques', true);
    }

    public function scopeForDomesticShipping($query)
    {
        return $query->where('supports_domestic', true);
    }

    public function scopeForInternationalShipping($query)
    {
        return $query->where('supports_international', true);
    }

    public function shippingOrders(): HasMany
    {
        return $this->hasMany(ShippingOrder::class);
    }
}
