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
        Schema::create('bids', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Auction being bid on
            $table->foreignUuid('auction_id')
                ->constrained('auctions')
                ->restrictOnDelete();

            // User placing the bid
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Bid details
            $table->decimal('amount', 12, 2);
            $table->char('currency', 3)->default('USD');

            // Bid status
            $table->enum('status', [
                'active',
                'winning',
                'outbid',
                'winning_bid',
                'rejected',
                'withdrawn',
            ])->default('active');

            // Optional information
            $table->string('bid_type')->default('standard');
            $table->timestamp('placed_at');
            $table->timestamp('rejected_at')->nullable();
            $table->string('rejection_reason')->nullable();

            $table->timestamps();

            // Common query indexes
            $table->index(['auction_id', 'amount']);
            $table->index(['auction_id', 'placed_at']);
            $table->index(['user_id', 'placed_at']);
            $table->index(['auction_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
