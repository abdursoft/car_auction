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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignUuid('auction_id')
                ->nullable()
                ->constrained('auctions')
                ->nullOnDelete();

            $table->string('payment_type', 30);
            // winning_bid, buy_now, deposit, shipping, refund, other

            $table->string('provider', 50)->nullable();
            // stripe, paypal, manual, etc.

            $table->string('provider_reference')->nullable()->unique();

            $table->decimal('amount', 12, 2);
            $table->char('currency', 3)->default('USD');

            $table->string('status', 30)->default('pending');
            // pending, processing, succeeded, failed, cancelled, refunded

            $table->string('payment_method', 50)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();

            $table->text('failure_reason')->nullable();
            $table->json('metadata')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['auction_id', 'payment_type']);
            $table->index(['provider', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
