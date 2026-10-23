<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // General information
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('provider_name')->nullable();
            $table->string('method_type', 40);
            // parcel, freight, vehicle_transport, air_freight,
            // sea_freight, road_freight, local_delivery, pickup

            $table->text('description')->nullable();
            $table->string('service_code')->nullable();

            // Shipment coverage
            $table->boolean('supports_domestic')->default(true);
            $table->boolean('supports_international')->default(false);
            $table->json('supported_countries')->nullable();
            $table->json('excluded_countries')->nullable();
            $table->json('supported_regions')->nullable();
            $table->json('supported_postal_codes')->nullable();

            // Supported auction items
            $table->boolean('supports_vehicles')->default(false);
            $table->boolean('supports_antiques')->default(true);
            $table->boolean('supports_fragile_items')->default(false);
            $table->boolean('supports_hazardous_items')->default(false);
            $table->boolean('supports_insured_shipments')->default(false);
            $table->boolean('supports_tracking')->default(true);
            $table->boolean('supports_pickup')->default(false);
            $table->boolean('supports_door_delivery')->default(true);

            // Package and weight limits
            $table->decimal('min_weight_kg', 10, 3)->nullable();
            $table->decimal('max_weight_kg', 10, 3)->nullable();
            $table->decimal('max_length_cm', 10, 2)->nullable();
            $table->decimal('max_width_cm', 10, 2)->nullable();
            $table->decimal('max_height_cm', 10, 2)->nullable();
            $table->decimal('max_declared_value', 14, 2)->nullable();

            // Pricing
            $table->char('currency', 3)->default('USD');
            $table->decimal('base_price', 12, 2)->default(0);
            $table->decimal('price_per_kg', 12, 2)->nullable();
            $table->decimal('price_per_km', 12, 2)->nullable();
            $table->decimal('fuel_surcharge_percent', 7, 3)->nullable();
            $table->decimal('insurance_rate_percent', 7, 3)->nullable();
            $table->decimal('remote_area_surcharge', 12, 2)->nullable();
            $table->decimal('customs_handling_fee', 12, 2)->nullable();
            $table->decimal('minimum_charge', 12, 2)->nullable();
            $table->boolean('requires_quote')->default(false);

            // Delivery estimates
            $table->unsignedSmallInteger('estimated_days_min')->nullable();
            $table->unsignedSmallInteger('estimated_days_max')->nullable();
            $table->unsignedSmallInteger('processing_days')->nullable();
            $table->boolean('supports_scheduled_delivery')->default(false);
            $table->boolean('supports_weekend_delivery')->default(false);

            // International shipping and customs
            $table->boolean('requires_customs_declaration')->default(false);
            $table->boolean('supports_duties_paid_delivery')->default(false);
            $table->boolean('supports_duties_unpaid_delivery')->default(true);
            $table->boolean('supports_import_export_documents')->default(false);
            $table->boolean('supports_customs_brokerage')->default(false);
            $table->json('required_customs_documents')->nullable();
            $table->json('restricted_item_categories')->nullable();
            $table->string('default_incoterm', 3)->nullable();
            // EXW, FCA, CPT, CIP, DAP, DPU, DDP, FAS, FOB, CFR, CIF

            // Collection and delivery requirements
            $table->boolean('requires_sender_address')->default(true);
            $table->boolean('requires_recipient_address')->default(true);
            $table->boolean('requires_phone_number')->default(true);
            $table->boolean('requires_signature')->default(false);
            $table->boolean('requires_identity_check')->default(false);
            $table->boolean('supports_address_validation')->default(false);

            // Insurance and claims
            $table->boolean('insurance_available')->default(false);
            $table->decimal('insurance_minimum_fee', 12, 2)->nullable();
            $table->decimal('insurance_maximum_coverage', 14, 2)->nullable();
            $table->unsignedSmallInteger('claim_deadline_days')->nullable();

            // Carrier integration
            $table->string('tracking_url_template')->nullable();
            $table->string('api_provider')->nullable();
            $table->boolean('supports_label_generation')->default(false);
            $table->boolean('supports_rate_calculation_api')->default(false);
            $table->boolean('supports_tracking_api')->default(false);

            // Administration
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->json('metadata')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_active', 'sort_order']);
            $table->index('method_type');
            $table->index(['supports_domestic', 'supports_international']);
            $table->index('provider_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
