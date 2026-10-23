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
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Manufacturer / Brand
            $table->foreignUuid('brand_id')
                ->constrained('brands')
                ->restrictOnDelete();

            // Model details
            $table->string('name');
            $table->string('slug');

            // Optional vehicle category
            $table->foreignUuid('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            // Optional model details
            $table->unsignedSmallInteger('start_year')->nullable();
            $table->unsignedSmallInteger('end_year')->nullable();
            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Prevent duplicate models under the same brand
            $table->unique(['brand_id', 'slug']);

            $table->index(['category_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_models');
    }
};
