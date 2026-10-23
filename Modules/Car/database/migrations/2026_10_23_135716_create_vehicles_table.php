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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Vehicle identification
            $table->string('vin')->nullable()->index();
            $table->unsignedSmallInteger('year');
            $table->string('trim')->nullable();

            // Relationships
            $table->foreignUuid('brand_id')
                ->constrained('brands')
                ->restrictOnDelete();

            $table->foreignUuid('vehicle_model_id')
                ->nullable()
                ->constrained('vehicle_models')
                ->nullOnDelete();

            $table->foreignUuid('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            // Specifications
            $table->unsignedInteger('mileage')->nullable();
            $table->string('engine_type')->nullable();
            $table->string('transmission')->nullable();
            $table->string('drivetrain')->nullable();
            $table->string('exterior_color')->nullable();
            $table->string('interior_color')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('vehicle_type')->nullable();

            // Condition and damage
            $table->enum('condition', [
                'excellent',
                'good',
                'fair',
                'poor',
            ])->nullable();

            $table->boolean('has_keys')->nullable();
            $table->boolean('engine_starts')->nullable();
            $table->boolean('drivetrain_operational')->nullable();
            $table->boolean('transmission_operational')->nullable();
            $table->enum('tire_condition', [
                'new',
                'good',
                'worn',
            ])->nullable();
            $table->boolean('frame_damage')->nullable();

            $table->string('primary_damage')->nullable();
            $table->string('secondary_damage')->nullable();
            $table->string('loss_type')->nullable();
            $table->string('title_status')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['brand_id', 'vehicle_model_id']);
            $table->index(['category_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
