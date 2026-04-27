<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // Category Details
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable(); // For Lucide icon names or SVG paths
            
            // Nested Categories (Self-referencing)
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('categories')
                  ->onDelete('cascade');
            
            // SEO & Sorting
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};