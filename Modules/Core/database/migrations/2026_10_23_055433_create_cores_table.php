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
        Schema::create('cores', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // General site information
            $table->string('site_name');
            $table->string('site_tagline')->nullable();
            $table->text('site_description')->nullable();
            $table->string('site_url')->nullable();

            // Contact information
            $table->string('site_email');
            $table->string('site_phone');
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();

            // Address
            $table->string('site_address')->nullable();
            $table->string('site_city')->nullable();
            $table->string('site_state')->nullable();
            $table->string('site_country')->nullable();
            $table->string('site_postal_code')->nullable();

            // Regional settings
            $table->string('site_currency', 3)->default('USD');
            $table->string('site_timezone')->default('UTC');
            $table->string('site_language', 10)->default('en');

            // Default SEO settings
            $table->string('site_meta_title')->nullable();
            $table->string('site_meta_description', 320)->nullable();
            $table->text('site_meta_keywords')->nullable();
            $table->string('site_og_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cores');
    }
};
