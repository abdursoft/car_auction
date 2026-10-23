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
        Schema::create('verifications', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('verification_type', 40);
            // identity, address, phone, email, business, tax, payment

            $table->string('status', 30)->default('pending');
            // pending, submitted, under_review, approved,
            // rejected, expired, resubmission_required

            $table->string('legal_first_name')->nullable();
            $table->string('legal_middle_name')->nullable();
            $table->string('legal_last_name')->nullable();
            $table->string('country_of_residence', 2)->nullable();
            $table->string('nationality', 2)->nullable();

            $table->string('document_type', 50)->nullable();
            // passport, national_id, driving_license, residence_permit

            $table->string('issuing_country', 2)->nullable();
            $table->string('document_number_encrypted')->nullable();
            $table->date('document_expiry_date')->nullable();

            $table->foreignUuid('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->text('rejection_reason')->nullable();
            $table->text('internal_notes')->nullable();
            $table->json('provider_response')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'verification_type', 'status']);
            $table->index(['status', 'submitted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};
