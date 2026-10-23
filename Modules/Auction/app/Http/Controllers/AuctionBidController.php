<?php

namespace Modules\Auction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Modules\Auction\Models\Auction;

class AuctionBidController extends Controller
{
    /**
     * List accepted bids for an auction.
     */
    public function index(Auction $auction): JsonResponse
    {
        $bids = $auction->bids()
            ->accepted()
            ->with('user:id,name')
            ->orderByDesc('amount')
            ->orderBy('placed_at')
            ->paginate(20);

        return response()->json($bids);
    }

    /**
     * Place a bid on an auction.
     */
    public function store(
        Request $request,
        Auction $auction
    ): JsonResponse {
        $validated = $request->validate([
            'amount' => [
                'required',
                'numeric',
                'gt:0',
                'decimal:0,2',
            ],
            'currency' => [
                'sometimes',
                'string',
                'size:3',
            ],
            'bid_type' => [
                'sometimes',
                'string',
                'in:standard,proxy,buy_now',
            ],
        ]);

        $bid = DB::transaction(function () use (
            $request,
            $auction,
            $validated
        ) {
            // Reload and lock the auction to serialize concurrent bids.
            $lockedAuction = Auction::query()
                ->whereKey($auction->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            $user = $request->user();

            if ($lockedAuction->user_id === $user->getKey()) {
                throw ValidationException::withMessages([
                    'auction' => 'You cannot bid on your own auction.',
                ]);
            }

            if ($lockedAuction->status !== 'live') {
                throw ValidationException::withMessages([
                    'auction' => 'This auction is not currently live.',
                ]);
            }

            $now = now();

            if (
                ($lockedAuction->starts_at &&
                    $now->lt($lockedAuction->starts_at)) ||
                ($lockedAuction->ends_at &&
                    $now->gte($lockedAuction->ends_at))
            ) {
                throw ValidationException::withMessages([
                    'auction' => 'This auction is outside its bidding period.',
                ]);
            }

            $currency = strtoupper(
                $validated['currency']
                    ?? $lockedAuction->currency
            );

            if ($currency !== $lockedAuction->currency) {
                throw ValidationException::withMessages([
                    'currency' => 'The bid currency must match the auction currency.',
                ]);
            }

            // Determine the minimum permitted bid.
            $minimumBid = $lockedAuction->current_bid
                ?? $lockedAuction->starting_bid;

            if (bccomp(
                (string) $validated['amount'],
                (string) $minimumBid,
                2
            ) <= 0) {
                throw ValidationException::withMessages([
                    'amount' => "Your bid must be higher than {$minimumBid}.",
                ]);
            }

            // Mark the previous leader as outbid.
            $lockedAuction->bids()
                ->whereIn('status', ['winning', 'winning_bid'])
                ->update(['status' => 'outbid']);

            $bid = $lockedAuction->bids()->create([
                'user_id' => $user->getKey(),
                'amount' => $validated['amount'],
                'currency' => $currency,
                'status' => 'winning',
                'bid_type' => $validated['bid_type'] ?? 'standard',
                'placed_at' => $now,
            ]);

            $lockedAuction->update([
                'current_bid' => $validated['amount'],
            ]);

            return $bid;
        }, 3);

        return response()->json([
            'message' => 'Your bid was placed successfully.',
            'bid' => $bid->load('user:id,name'),
        ], 201);
    }
}