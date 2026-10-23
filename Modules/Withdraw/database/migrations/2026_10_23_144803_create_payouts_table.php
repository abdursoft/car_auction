<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Payout owner
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Related auction and payment, when applicable
            $table->foreignUuid('auction_id')
                ->nullable()
                ->constrained('auctions')
                ->nullOnDelete();

            $table->foreignUuid('payment_id')
                ->nullable()
                ->constrained('payments')
                ->nullOnDelete();

            // Payout identification
            $table->string('payout_number')->unique();
            $table->string('payout_type', 30)->default('withdrawal');
            // withdrawal, auction_sale, refund, adjustment

            // Amounts
            $table->char('currency', 3)->default('USD');
            $table->decimal('requested_amount', 14, 2);
            $table->decimal('processing_fee', 14, 2)->default(0);
            $table->decimal('tax_amount', 14, 2)->default(0);
            $table->decimal('net_amount', 14, 2);

            // Destination
            $table->string('payout_method', 40);
            // bank_transfer, mobile_money, paypal, stripe, other

            $table->string('recipient_name')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('recipient_phone')->nullable();
            $table->char('destination_country', 2)->nullable();

            // Store only masked account details and provider tokens.
            // Never store banking passwords, PINs, CVVs, or full card data.
            $table->string('bank_name')->nullable();
            $table->string('bank_account_holder')->nullable();
            $table->string('bank_account_last4', 4)->nullable();
            $table->string('bank_routing_last4', 4)->nullable();
            $table->string('bank_account_token')->nullable();
            $table->string('mobile_money_provider')->nullable();
            $table->string('mobile_money_number_last4', 4)->nullable();
            $table->string('provider_account_id')->nullable();

            // International transfer details
            $table->string('bank_country', 2)->nullable();
            $table->string('bank_currency', 3)->nullable();
            $table->string('swift_bic')->nullable();
            $table->string('iban_last4', 4)->nullable();
            $table->string('intermediary_bank_reference')->nullable();
            $table->decimal('exchange_rate', 18, 8)->nullable();
            $table->char('settlement_currency', 3)->nullable();
            $table->decimal('settlement_amount', 14, 2)->nullable();
            $table->decimal('international_transfer_fee', 14, 2)->default(0);

            // Processing status
            $table->string('status', 30)->default('pending');
            // pending, under_review, approved, processing, paid,
            // failed, rejected, cancelled, reversed

            $table->string('provider_name')->nullable();
            $table->string('provider_payout_id')->nullable()->unique();
            $table->string('provider_transaction_id')->nullable();
            $table->text('provider_response')->nullable();

            // Review and processing
            $table->foreignUuid('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignUuid('processed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('requested_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            // Failure, rejection, or reversal
            $table->string('failure_code')->nullable();
            $table->text('failure_reason')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->string('reversal_reference')->nullable();
            $table->timestamp('reversed_at')->nullable();

            // Compliance and audit
            $table->string('reference_number')->nullable();
            $table->text('admin_notes')->nullable();
            $table->json('metadata')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'status', 'created_at']);
            $table->index(['status', 'requested_at']);
            $table->index(['payout_type', 'status']);
            $table->index(['auction_id', 'payout_type']);
            $table->index(['provider_name', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};