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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('wallet_id')
                ->constrained('wallets')
                ->restrictOnDelete();

            $table->foreignUuid('sender_wallet_id')
                ->nullable()
                ->constrained('wallets')
                ->restrictOnDelete();

            $table->foreignUuid('receiver_wallet_id')
                ->nullable()
                ->constrained('wallets')
                ->restrictOnDelete();

            $table->foreignUuid('payout_id')
                ->nullable()
                ->constrained('payouts')
                ->nullOnDelete();

            $table->foreignUuid('payment_id')
                ->nullable()
                ->constrained('payments')
                ->nullOnDelete();

            $table->string('transaction_number')->unique();

            $table->string('type', 40);
            // deposit, auction_sale, purchase, refund, fee,
            // withdrawal, hold, release, adjustment

            $table->enum('direction', ['credit', 'debit', 'hold'])->default('debit');
            // credit, debit

            $table->decimal('amount', 14, 2);
            $table->char('currency', 3);

            $table->decimal('balance_before', 14, 2);
            $table->decimal('balance_after', 14, 2);
            $table->decimal('transaction_fee', 14, 2)->default(0);

            $table->string('status', 20)->default('completed');
            // pending, completed, failed, reversed

            $table->string('reference')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();

            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['sender_wallet_id', 'created_at']);
            $table->index(['sender_wallet_id', 'status']);
            $table->index(['type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
