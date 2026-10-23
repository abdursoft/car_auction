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
        Schema::create('verification_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignUuid('verification_id')
                ->nullable()
                ->constrained('verifications')
                ->nullOnDelete();

            $table->enum('document_type', [
                'passport',
                'national_id',
                'driving_license',
                'proof_of_address',
                'business_license',
                'tax_certificate',
                'other'
            ])->default('passport');
            // passport, national_id, driving_license, proof_of_address,
            // business_license, tax_certificate, other

            $table->string('original_filename')->nullable();
            $table->string('storage_disk')->default('private');
            $table->string('storage_path');
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->string('file_hash', 64)->nullable();

            $table->string('document_side', 20)->nullable();
            // front, back, single, supporting

            $table->string('status', 30)->default('uploaded');
            // uploaded, pending_review, accepted, rejected, expired

            $table->timestamp('uploaded_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('rejection_reason')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'document_type']);
            $table->index(['buyer_verification_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_documents');
    }
};
