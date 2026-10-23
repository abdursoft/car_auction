<?php

namespace Modules\Auction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Modules\Auction\Models\Auction;
use Modules\Auction\Models\AuctionResult;

class AuctionResultController extends Controller
{
    public function index(Request $request)
    {
        $results = AuctionResult::query()
            ->with(['auction', 'winningUser', 'winningBid'])
            ->when($request->filled('result'), fn ($q) =>
                $q->where('result', $request->input('result'))
            )
            ->latest()
            ->paginate(min(max($request->integer('per_page', 15), 1), 100))
            ->withQueryString();

        return response()->json($results);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'auction_id' => [
                'required',
                'uuid',
                Rule::exists('auctions', 'id')->whereNull('deleted_at'),
                Rule::unique('auction_results', 'auction_id'),
            ],
            'winning_user_id' => [
                'nullable',
                'uuid',
                Rule::exists('users', 'id'),
            ],
            'winning_bid_id' => [
                'nullable',
                'uuid',
                Rule::exists('bids', 'id'),
            ],
            'result' => [
                'required',
                Rule::in(['pending', 'sold', 'unsold', 'no_sale', 'cancelled']),
            ],
            'final_price' => ['nullable', 'numeric', 'min:0', 'max:9999999999.99'],
            'currency' => ['sometimes', 'required', 'string', 'size:3'],
            'finalized_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $result = DB::transaction(function () use ($validated) {
            $auction = Auction::query()
                ->lockForUpdate()
                ->findOrFail($validated['auction_id']);

            $this->validateWinningBid($validated, $auction);

            if (
                ($validated['result'] ?? null) === 'sold'
                && (
                    empty($validated['winning_user_id'])
                    || empty($validated['winning_bid_id'])
                    || !array_key_exists('final_price', $validated)
                    || $validated['final_price'] === null
                )
            ) {
                throw ValidationException::withMessages([
                    'result' => 'A sold result requires a winning user, winning bid, and final price.',
                ]);
            }

            $validated['finalized_at'] ??= now();

            $result = AuctionResult::create($validated);

            if ($validated['result'] !== 'pending') {
                $auction->update([
                    'status' => match ($validated['result']) {
                        'sold' => 'sold',
                        'cancelled' => 'cancelled',
                        default => 'ended',
                    },
                ]);
            }

            return $result;
        });

        return response()->json([
            'message' => 'Auction result recorded successfully.',
            'data' => $result->load(['auction', 'winningUser', 'winningBid']),
        ], 201);
    }

    public function show(AuctionResult $auctionResult)
    {
        return response()->json([
            'data' => $auctionResult->load([
                'auction',
                'winningUser',
                'winningBid',
            ]),
        ]);
    }

    public function update(Request $request, AuctionResult $auctionResult)
    {
        $validated = $request->validate([
            'winning_user_id' => [
                'sometimes',
                'nullable',
                'uuid',
                Rule::exists('users', 'id'),
            ],
            'winning_bid_id' => [
                'sometimes',
                'nullable',
                'uuid',
                Rule::exists('bids', 'id'),
            ],
            'result' => [
                'sometimes',
                'required',
                Rule::in(['pending', 'sold', 'unsold', 'no_sale', 'cancelled']),
            ],
            'final_price' => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:9999999999.99'],
            'currency' => ['sometimes', 'required', 'string', 'size:3'],
            'finalized_at' => ['sometimes', 'nullable', 'date'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ]);

        DB::transaction(function () use ($validated, $auctionResult) {
            $auction = Auction::query()
                ->lockForUpdate()
                ->findOrFail($auctionResult->auction_id);

            $effective = array_merge($auctionResult->only([
                'winning_user_id',
                'winning_bid_id',
                'result',
                'final_price',
                'currency',
            ]), $validated);

            $this->validateWinningBid($effective, $auction);

            if (
                ($effective['result'] ?? null) === 'sold'
                && (
                    empty($effective['winning_user_id'])
                    || empty($effective['winning_bid_id'])
                    || $effective['final_price'] === null
                )
            ) {
                throw ValidationException::withMessages([
                    'result' => 'A sold result requires a winning user, winning bid, and final price.',
                ]);
            }

            if (
                isset($validated['result'])
                && $validated['result'] !== 'pending'
                && !array_key_exists('finalized_at', $validated)
            ) {
                $validated['finalized_at'] = now();
            }

            $auctionResult->update($validated);

            if (isset($validated['result']) && $validated['result'] !== 'pending') {
                $auction->update([
                    'status' => match ($validated['result']) {
                        'sold' => 'sold',
                        'cancelled' => 'cancelled',
                        default => 'ended',
                    },
                ]);
            }
        });

        return response()->json([
            'message' => 'Auction result updated successfully.',
            'data' => $auctionResult->fresh()->load([
                'auction',
                'winningUser',
                'winningBid',
            ]),
        ]);
    }

    public function destroy(AuctionResult $auctionResult)
    {
        return response()->json([
            'message' => 'Auction results are retained as an audit record and cannot be deleted.',
        ], 405);
    }

    private function validateWinningBid(array $data, Auction $auction): void
    {
        $bidId = $data['winning_bid_id'] ?? null;
        $userId = $data['winning_user_id'] ?? null;

        if (!$bidId) {
            return;
        }

        $bid = $auction->bids()
            ->whereKey($bidId)
            ->first();

        if (!$bid) {
            throw ValidationException::withMessages([
                'winning_bid_id' => 'The selected bid does not belong to this auction.',
            ]);
        }

        if ($userId && $bid->user_id !== $userId) {
            throw ValidationException::withMessages([
                'winning_user_id' => 'The winning user must match the selected bid.',
            ]);
        }

        if (isset($data['final_price']) && (float) $data['final_price'] !== (float) $bid->amount) {
            throw ValidationException::withMessages([
                'final_price' => 'The final price must match the winning bid amount.',
            ]);
        }
    }
}