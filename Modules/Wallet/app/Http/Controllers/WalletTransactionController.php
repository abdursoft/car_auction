<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Wallet\Models\Wallet;
use Modules\Wallet\Models\WalletTransaction;

class WalletTransactionController extends Controller
{
    /**
     * List transactions belonging to the authenticated user's wallet.
     */
    public function index(
        Request $request,
        string $wallet
    ): JsonResponse {
        $walletModel = $request->user()
            ->wallets()
            ->whereKey($wallet)
            ->firstOrFail();

        $transactions = $walletModel->transactions()
            ->with([
                'senderWallet:id,wallet_number',
                'receiverWallet:id,wallet_number',
            ])
            ->latest()
            ->paginate(20);

        return response()->json($transactions);
    }

    /**
     * Display a single transaction from the user's wallet.
     */
    public function show(
        Request $request,
        string $wallet,
        string $transaction
    ): JsonResponse {
        $walletModel = $request->user()
            ->wallets()
            ->whereKey($wallet)
            ->firstOrFail();

        $transactionModel = $walletModel->transactions()
            ->with([
                'senderWallet:id,wallet_number',
                'receiverWallet:id,wallet_number',
            ])
            ->whereKey($transaction)
            ->firstOrFail();

        return response()->json([
            'data' => $transactionModel,
        ]);
    }
}