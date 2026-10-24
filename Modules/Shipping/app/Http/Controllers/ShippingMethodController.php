<?php

namespace Modules\Shipping\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Shipping\Models\ShippingMethod;

class ShippingMethodController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = ShippingMethod::query()
            ->active()
            ->select([
                'id',
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
                'supports_vehicles',
                'supports_antiques',
                'supports_fragile_items',
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
                'insurance_available',
                'insurance_minimum_fee',
                'insurance_maximum_coverage',
                'is_active',
                'sort_order',
            ]);

        if ($request->filled('method_type')) {
            $query->where('method_type', $request->string('method_type')->toString());
        }

        if ($request->boolean('vehicles_only')) {
            $query->forVehicles();
        }

        if ($request->boolean('antiques_only')) {
            $query->forAntiques();
        }

        if ($request->boolean('international_only')) {
            $query->forInternationalShipping();
        }

        if ($request->boolean('domestic_only')) {
            $query->forDomesticShipping();
        }

        $methods = $query
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return response()->json($methods);
    }

    public function show(string $id): JsonResponse
    {
        $method = ShippingMethod::query()
            ->active()
            ->select([
                'id',
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
                'supports_label_generation',
                'supports_rate_calculation_api',
                'supports_tracking_api',
            ])
            ->findOrFail($id);

        return response()->json(['shipping_method' => $method]);
    }
}