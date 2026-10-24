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
        Schema::create('shipping_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('auction_id')
                ->constrained('auctions')
                ->restrictOnDelete();

            $table->foreignUuid('buyer_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignUuid('seller_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Selected configured shipping method
            $table->foreignUuid('shipping_method_id')
                ->nullable()
                ->constrained('shipping_methods')
                ->nullOnDelete();

            $table->string('delivery_method', 30)->default('shipping');
            // shipping, pickup, local_delivery

            // Snapshot of the selected service
            $table->string('shipping_method_name')->nullable();
            $table->string('carrier', 100)->nullable();
            $table->string('service_code')->nullable();

            $table->string('tracking_number')->nullable();
            $table->string('tracking_url')->nullable();

            $table->string('status', 30)->default('pending');
            // pending, preparing, shipped, in_transit,
            // delivered, ready_for_pickup, picked_up,
            // failed, returned, cancelled

            $table->json('recipient_address')->nullable();
            $table->json('pickup_details')->nullable();

            // Price snapshot at checkout
            $table->decimal('shipping_cost', 12, 2)->nullable();
            $table->char('currency', 3)->default('USD');

            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('estimated_delivery_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('picked_up_at')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index(['buyer_id', 'status']);
            $table->index(['seller_id', 'status']);
            $table->index('tracking_number');
            $table->index('shipping_method_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_orders');
    }
};
