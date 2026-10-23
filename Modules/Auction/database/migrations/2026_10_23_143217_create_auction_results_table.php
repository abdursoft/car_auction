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
        Schema::create('auction_results', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('auction_id')
                ->unique()
                ->constrained('auctions')
                ->restrictOnDelete();

            $table->foreignUuid('winning_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignUuid('winning_bid_id')
                ->nullable()
                ->constrained('bids')
                ->nullOnDelete();

            $table->string('result', 30)->default('pending');
            // pending, sold, unsold, no_sale, cancelled

            $table->decimal('final_price', 12, 2)->nullable();
            $table->char('currency', 3)->default('USD');

            $table->timestamp('finalized_at')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['result', 'finalized_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_results');
    }
};
