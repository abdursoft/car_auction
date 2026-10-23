<?php

namespace Modules\Auction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Auction\Models\Auction;
use Modules\Auction\Models\Watchlist;

class AuctionWatchController extends Controller
{
    public function index(Request $request)
    {
        $watchlists = Watchlist::query()
            ->where('user_id', $request->user()->id)
            ->with([
                'auction.vehicle.brand',
                'auction.vehicle.vehicleModel',
                'auction.antique',
                'auction.images',
            ])
            ->latest()
            ->paginate(min(max($request->integer('per_page', 15), 1), 100));

        return response()->json($watchlists);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'auction_id' => [
                'required',
                'uuid',
                Rule::exists('auctions', 'id')->whereNull('deleted_at'),
            ],
        ]);

        $auction = Auction::query()
            ->whereKey($validated['auction_id'])
            ->whereIn('status', ['upcoming', 'live'])
            ->first();

        if (!$auction) {
            return response()->json([
                'message' => 'Only upcoming or live auctions can be added to a watchlist.',
            ], 422);
        }

        $watchlist = Watchlist::firstOrCreate([
            'user_id' => $request->user()->id,
            'auction_id' => $auction->id,
        ]);

        return response()->json([
            'message' => $watchlist->wasRecentlyCreated
                ? 'Auction added to your watchlist.'
                : 'Auction is already in your watchlist.',
            'data' => $watchlist->load('auction'),
        ], $watchlist->wasRecentlyCreated ? 201 : 200);
    }

    public function destroy(Request $request, Auction $auction)
    {
        $deleted = Watchlist::query()
            ->where('user_id', $request->user()->id)
            ->where('auction_id', $auction->id)
            ->delete();

        if (!$deleted) {
            return response()->json([
                'message' => 'Auction was not found in your watchlist.',
            ], 404);
        }

        return response()->json([
            'message' => 'Auction removed from your watchlist.',
        ]);
    }

    public function check(Request $request, Auction $auction)
    {
        $isWatching = Watchlist::query()
            ->where('user_id', $request->user()->id)
            ->where('auction_id', $auction->id)
            ->exists();

        return response()->json([
            'auction_id' => $auction->id,
            'is_watching' => $isWatching,
        ]);
    }
}