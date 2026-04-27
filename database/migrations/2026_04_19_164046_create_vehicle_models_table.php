<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();
            // Link to the Brand (Manufacturer)
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            
            $table->string('name');
            $table->string('slug');
            
            // Optional: You can categorize models (e.g., 911 is a "Coupe")
            $table->foreignId('category_id')->nullable()->constrained();
            
            $table->timestamps();
            
            // Ensure we don't have duplicate models for the same brand
            $table->unique(['brand_id', 'slug']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('vehicle_models');
    }
};