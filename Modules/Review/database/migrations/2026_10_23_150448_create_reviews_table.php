<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Reviewer and reviewed user
            $table->foreignUuid('reviewer_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignUuid('reviewed_user_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Related auction
            $table->foreignUuid('auction_id')
                ->nullable()
                ->constrained('auctions')
                ->nullOnDelete();

            // Review classification
            $table->string('review_type', 30)->default('seller');
            // seller, buyer, shipping, platform

            // Rating
            $table->unsignedTinyInteger('rating');
            $table->unsignedTinyInteger('communication_rating')->nullable();
            $table->unsignedTinyInteger('accuracy_rating')->nullable();
            $table->unsignedTinyInteger('shipping_rating')->nullable();
            $table->unsignedTinyInteger('professionalism_rating')->nullable();

            // Review content
            $table->string('title')->nullable();
            $table->text('comment')->nullable();

            // Moderation
            $table->enum('status', ['pending', 'published', 'hidden', 'rejected'])->default('pending');

            $table->boolean('is_verified_purchase')->default(false);
            $table->boolean('is_anonymous')->default(false);
            $table->boolean('is_featured')->default(false);

            // Seller response  
            $table->text('response')->nullable();
            $table->timestamp('responded_at')->nullable();

            // Moderation details
            $table->foreignUuid('moderated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('moderated_at')->nullable();
            $table->text('moderation_reason')->nullable();

            // Community feedback
            $table->unsignedInteger('helpful_count')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['reviewed_user_id', 'status']);
            $table->index(['reviewer_id', 'created_at']);
            $table->index(['auction_id', 'review_type']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};