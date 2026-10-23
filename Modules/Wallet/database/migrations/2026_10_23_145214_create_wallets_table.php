<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Wallet owner
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Wallet identification
            $table->string('wallet_number')->unique();
            $table->string('wallet_type', 30)->default('seller');
            // buyer, seller, admin, escrow

            $table->char('currency', 3)->default('USD');

            // Balance snapshots (ledger remains the source of truth)
            $table->decimal('balance', 14, 2)->default(0);
            $table->decimal('available_balance', 14, 2)->default(0);
            $table->decimal('pending_balance', 14, 2)->default(0);
            $table->decimal('reserved_balance', 14, 2)->default(0);
            $table->decimal('withdrawn_balance', 14, 2)->default(0);

            // Wallet status
            $table->string('status', 20)->default('active');
            // active, frozen, suspended, closed

            $table->boolean('is_primary')->default(false);
            $table->timestamp('last_transaction_at')->nullable();
            $table->text('freeze_reason')->nullable();

            $table->json('metadata')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['user_id', 'currency', 'wallet_type']);
            $table->index(['user_id', 'status']);
            $table->index(['status', 'currency']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};