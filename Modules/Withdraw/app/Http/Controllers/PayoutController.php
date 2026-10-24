<?php

namespace Modules\Withdraw\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\Wallet\Models\Wallet;
use Modules\Withdraw\Models\Payout;

class PayoutController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $payouts = $request->user()
            ->payouts()
            ->latest()
            ->paginate(20);

        return response()->json($payouts);
    }

    public function show(
        Request $request,
        string $payout
    ): JsonResponse {
        $payout = $request->user()
            ->payouts()
            ->whereKey($payout)
            ->firstOrFail();

        return response()->json([
            'data' => $payout,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'wallet_id' => [
                'required',
                'uuid',
                Rule::exists('wallets', 'id')
                    ->where('user_id', $request->user()->getKey())
                    ->where('status', 'active'),
            ],
            'amount' => [
                'required',
                'numeric',
                'gt:0',
                'decimal:0,2',
            ],
            'payout_method' => [
                'required',
                Rule::in([
                    'bank_transfer',
                    'mobile_money',
                    'paypal',
                    'stripe',
                    'other',
                ]),
            ],
            'recipient_name' => ['nullable', 'string', 'max:255'],
            'recipient_email' => ['nullable', 'email', 'max:255'],
            'recipient_phone' => ['nullable', 'string', 'max:30'],
            'destination_country' => ['nullable', 'string', 'size:2'],
            'provider_account_id' => ['nullable', 'string', 'max:255'],
        ]);

        $payout = DB::transaction(function () use (
            $request,
            $validated
        ) {
            $user = $request->user();

            $wallet = Wallet::query()
                ->whereKey($validated['wallet_id'])
                ->where('user_id', $user->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            if ($wallet->status !== 'active') {
                abort(422, 'This wallet cannot be used for payouts.');
            }

            $amount = (string) $validated['amount'];

            if (bccomp($wallet->available_balance, $amount, 2) < 0) {
                abort(422, 'Insufficient available balance.');
            }

            // TODO: Calculate fees and taxes using server-side rules.
            $processingFee = '0.00';
            $taxAmount = '0.00';

            $netAmount = bcsub(
                bcsub($amount, $processingFee, 2),
                $taxAmount,
                2
            );

            if (bccomp($netAmount, '0.00', 2) <= 0) {
                abort(422, 'The net payout amount must be positive.');
            }

            // Reserve funds immediately to prevent duplicate withdrawals.
            $wallet->available_balance = bcsub(
                $wallet->available_balance,
                $amount,
                2
            );

            $wallet->reserved_balance = bcadd(
                $wallet->reserved_balance,
                $amount,
                2
            );

            $wallet->save();

            return Payout::create([
                'user_id' => $user->getKey(),
                'payout_number' => 'PO-' . Str::upper(Str::random(20)),
                'payout_type' => 'withdrawal',
                'currency' => $wallet->currency,
                'requested_amount' => $amount,
                'processing_fee' => $processingFee,
                'tax_amount' => $taxAmount,
                'net_amount' => $netAmount,
                'payout_method' => $validated['payout_method'],
                'recipient_name' => $validated['recipient_name'] ?? null,
                'recipient_email' => $validated['recipient_email'] ?? null,
                'recipient_phone' => $validated['recipient_phone'] ?? null,
                'destination_country' => isset($validated['destination_country'])
                    ? strtoupper($validated['destination_country'])
                    : null,
                'provider_account_id' => $validated['provider_account_id'] ?? null,
                'status' => 'pending',
                'requested_at' => now(),
            ]);
        });

        return response()->json([
            'message' => 'Payout request submitted successfully.',
            'data' => $payout,
        ], 201);
    }
}