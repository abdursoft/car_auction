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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('address_type', ['shipping', 'billing', 'residential', 'business'])->default('shipping');
            // shipping, billing, residential, business

            $table->string('recipient_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('phone_number', 30)->nullable();

            // Address details
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('district')->nullable();
            $table->string('city');
            $table->string('state_province')->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 2);

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->boolean('is_default_shipping')->default(false);
            $table->boolean('is_default_billing')->default(false);

            $table->text('delivery_instructions')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'address_type']);
            $table->index(['country', 'postal_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
