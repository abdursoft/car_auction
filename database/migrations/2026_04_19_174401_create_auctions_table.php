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
            $table->id();
            $table->string('stock_number')->unique(); // Unique IAA identifier
            $table->string('vin')->index();

            // Core Relations
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->foreignId('vehicle_model_id')->nullable()->constrained('vehicle_models')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete(); // Seller/Owner

            // Vehicle Details
            $table->integer('year');
            $table->string('trim')->nullable();
            $table->string('mileage');
            $table->string('engine_type')->nullable();
            $table->string('transmission')->nullable();
            $table->string('drivetrain')->nullable();
            $table->string('exterior_color')->nullable();
            $table->string('interior_color')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('vehicle_type')->nullable(); // e.g., Sedan, SUV, Coupe
            $table->string('image_url')->nullable(); // Main image
            $table->json('additional_images')->nullable(); // Array of additional image URLs
            $table->text('description')->nullable();
            $table->string('location')->nullable(); // City, State or specific lot location
            $table->string('lot_number')->nullable(); // IAAI lot number
            $table->enum('has_keys', ['yes', 'no'])->nullable();

            // technical specifications (Optional, can be stored as JSON for flexibility) 
            $table->enum('condition', ['excellent', 'good', 'fair', 'poor'])->nullable();
            $table->enum('engin_start', ['yes', 'no'])->nullable();
            $table->enum('drivetrain_start', ['yes', 'no'])->nullable();
            $table->enum('transmission_start', ['yes', 'no'])->nullable();
            $table->enum('tire_condition', ['new', 'good', 'worn'])->nullable();
            $table->enum('frame_damage', ['yes', 'no'])->nullable();
            

            // Damage/Condition (Specific to IAAI)
            $table->string('primary_damage')->nullable();
            $table->string('secondary_damage')->nullable();
            $table->string('loss_type')->nullable(); // e.g., Collision, Fire, Flood
            $table->string('title_status')->nullable(); // e.g., Salvage, Clean, Junk

            // Auction Logic
            $table->string('location_branch')->nullable();
            $table->enum('is_upcoming', ['yes', 'no'])->default('no');
            $table->unsignedBigInteger('is_buy_now')->default(0);
            $table->unsignedBigInteger('starting_bid')->default(0);
            $table->unsignedBigInteger('current_bid')->default(0);
            $table->unsignedBigInteger('reserve_price')->nullable();
            $table->timestamp('auction_date')->nullable(); // The 'end_date' from your API
            $table->enum('auction_type', ['live', 'online'])->default('online');
            $table->enum('status', ['upcoming', 'live', 'sold', 'closed'])->default('upcoming');

            $table->timestamps();
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
