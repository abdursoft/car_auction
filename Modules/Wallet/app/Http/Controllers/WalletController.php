<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\Wallet\Models\Wallet;

class WalletController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $wallets = $request->user()
            ->wallets()
            ->latest()
            ->paginate(20);

        return response()->json($wallets);
    }

    public function show(Request $request, string $wallet): JsonResponse
    {
        $wallet = $request->user()
            ->wallets()
            ->whereKey($wallet)
            ->firstOrFail();

        return response()->json([
            'data' => $wallet,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'wallet_type' => [
                'required',
                Rule::in(['buyer', 'seller']),
            ],
            'currency' => [
                'required',
                'string',
                'size:3',
                'regex:/^[A-Z]{3}$/',
            ],
            'is_primary' => [
                'sometimes',
                'boolean',
            ],
        ]);

        $user = $request->user();

        $wallet = DB::transaction(function () use (
            $user,
            $validated
        ) {
            $existing = Wallet::query()
                ->where('user_id', $user->getKey())
                ->where('currency', $validated['currency'])
                ->where('wallet_type', $validated['wallet_type'])
                ->lockForUpdate()
                ->first();

            if ($existing) {
                abort(409, 'A wallet of this type and currency already exists.');
            }

            $makePrimary = $validated['is_primary'] ?? false;

            if ($makePrimary) {
                Wallet::query()
                    ->where('user_id', $user->getKey())
                    ->where('currency', $validated['currency'])
                    ->where('wallet_type', $validated['wallet_type'])
                    ->update(['is_primary' => false]);
            }

            return Wallet::create([
                'user_id' => $user->getKey(),
                'wallet_number' => 'WAL-' . Str::uuid(),
                'wallet_type' => $validated['wallet_type'],
                'currency' => $validated['currency'],
                'status' => 'active',
                'is_primary' => $makePrimary,
                // Balance columns use database defaults.
            ]);
        });

        return response()->json([
            'message' => 'Wallet created successfully.',
            'data' => $wallet,
        ], 201);
    }
}