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
        Schema::create('auctions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Listing type: vehicle or antique
            $table->enum('listing_type', [
                'vehicle',
                'antique',
            ])->default('vehicle')->index();

            // Vehicle relationship (required for vehicle listings)
            $table->foreignUuid('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->nullOnDelete();

            // Antique relationship (required for antique listings)
            $table->foreignUuid('antique_id')
                ->nullable()
                ->constrained('antiques')
                ->nullOnDelete();

            // Seller / Owner
            $table->foreignUuid('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // External auction identification
            $table->string('stock_number')->unique();
            $table->string('lot_number')->nullable();

            // Location
            $table->string('location')->nullable();
            $table->string('location_branch')->nullable();

            // Pricing
            $table->decimal('starting_bid', 12, 2)->default(0);
            $table->decimal('current_bid', 12, 2)->default(0);
            $table->decimal('reserve_price', 12, 2)->nullable();

            $table->boolean('buy_now_enabled')->default(false);
            $table->decimal('buy_now_price', 12, 2)->nullable();
            $table->char('currency', 3)->default('USD');

            // Auction configuration
            $table->enum('auction_type', [
                'live',
                'online',
            ])->default('online');

            // Schedule
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            // Auction lifecycle
            $table->enum('status', [
                'draft',
                'upcoming',
                'live',
                'ended',
                'sold',
                'cancelled',
            ])->default('draft');

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['status', 'starts_at']);
            $table->index(['user_id', 'status']);
            $table->index(['listing_type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
