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
        Schema::create('buyer_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            // Personal information
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('display_name')->nullable();
            $table->string('profile_photo')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 30)->nullable();

            // Contact information
            $table->string('phone_number', 30)->nullable();
            $table->string('alternate_phone_number', 30)->nullable();
            $table->string('preferred_language', 10)->nullable();
            $table->string('timezone')->nullable();

            // Buyer account preferences
            $table->string('buyer_type', 30)->default('individual');
            // individual, business, dealer

            $table->string('company_name')->nullable();
            $table->string('business_registration_number')->nullable();
            $table->string('tax_identification_number')->nullable();

            // Marketplace preferences
            $table->string('preferred_currency', 3)->default('USD');
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('marketing_notifications')->default(false);

            // Account readiness
            $table->boolean('profile_completed')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->index('buyer_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_profiles');
    }
};
