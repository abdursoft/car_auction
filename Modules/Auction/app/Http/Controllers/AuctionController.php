<?php

namespace Modules\Auction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Modules\Auction\Models\Auction;

class AuctionController extends Controller
{
    public function index(Request $request)
    {
        $auctions = Auction::query()
            ->with(['seller', 'vehicle.brand', 'vehicle.vehicleModel', 'antique', 'images'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('stock_number', 'like', "%{$search}%")
                        ->orWhere('lot_number', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('listing_type'), fn ($q) =>
                $q->where('listing_type', $request->input('listing_type'))
            )
            ->when($request->filled('status'), fn ($q) =>
                $q->where('status', $request->input('status'))
            )
            ->when($request->filled('auction_type'), fn ($q) =>
                $q->where('auction_type', $request->input('auction_type'))
            )
            ->when($request->filled('user_id'), fn ($q) =>
                $q->where('user_id', $request->input('user_id'))
            )
            ->orderByDesc('created_at')
            ->paginate(min(max($request->integer('per_page', 15), 1), 100))
            ->withQueryString();

        return response()->json($auctions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $this->validateListing($validated);
        $this->validateSchedule($validated);
        $this->validatePricing($validated);

        $validated['current_bid'] = $validated['starting_bid'] ?? 0;

        $auction = Auction::create($validated);

        return response()->json([
            'message' => 'Auction created successfully.',
            'data' => $auction->load([
                'seller',
                'vehicle.brand',
                'vehicle.vehicleModel',
                'antique',
                'images',
            ]),
        ], 201);
    }

    public function show(Auction $auction)
    {
        return response()->json([
            'data' => $auction->load([
                'seller',
                'vehicle.brand',
                'vehicle.vehicleModel',
                'antique.materials',
                'images',
                'result',
            ]),
        ]);
    }

    public function update(Request $request, Auction $auction)
    {
        $validated = $request->validate($this->rules(true));

        $effective = array_merge($auction->only([
            'listing_type',
            'vehicle_id',
            'antique_id',
            'starting_bid',
            'reserve_price',
            'buy_now_enabled',
            'buy_now_price',
            'starts_at',
            'ends_at',
            'status',
        ]), $validated);

        $this->validateListing($effective);
        $this->validateSchedule($effective);
        $this->validatePricing($effective);

        // Current bid is controlled by the bidding process, not ordinary updates.
        unset($validated['current_bid']);

        $auction->update($validated);

        return response()->json([
            'message' => 'Auction updated successfully.',
            'data' => $auction->fresh()->load([
                'seller',
                'vehicle.brand',
                'vehicle.vehicleModel',
                'antique',
                'images',
            ]),
        ]);
    }

    public function destroy(Auction $auction)
    {
        if ($auction->bids()->exists() || $auction->payments()->exists()) {
            return response()->json([
                'message' => 'Auctions with bids or payments cannot be deleted.',
            ], 422);
        }

        $auction->delete();

        return response()->json([
            'message' => 'Auction deleted successfully.',
        ]);
    }

    private function rules(bool $isUpdate = false): array
    {
        $required = $isUpdate ? 'sometimes|required' : 'required';

        return [
            'listing_type' => [
                $required,
                Rule::in(['vehicle', 'antique']),
            ],
            'vehicle_id' => [
                'nullable',
                'uuid',
                Rule::exists('vehicles', 'id')->whereNull('deleted_at'),
            ],
            'antique_id' => [
                'nullable',
                'uuid',
                Rule::exists('antiques', 'id')->whereNull('deleted_at'),
            ],
            'user_id' => [
                'nullable',
                'uuid',
                Rule::exists('users', 'id'),
            ],
            'stock_number' => [
                $required,
                'string',
                'max:255',
                Rule::unique('auctions', 'stock_number')
                    ->ignore(request()->route('auction')?->id),
            ],
            'lot_number' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'location_branch' => ['nullable', 'string', 'max:255'],

            'starting_bid' => [$required, 'numeric', 'min:0', 'max:9999999999.99'],
            'reserve_price' => ['nullable', 'numeric', 'min:0', 'max:9999999999.99'],
            'buy_now_enabled' => ['sometimes', 'boolean'],
            'buy_now_price' => ['nullable', 'numeric', 'gt:0', 'max:9999999999.99'],
            'currency' => ['sometimes', 'string', 'size:3'],

            'auction_type' => [
                'sometimes',
                Rule::in(['live', 'online']),
            ],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after:starts_at'],
            'status' => [
                'sometimes',
                Rule::in(['draft', 'upcoming', 'live', 'ended', 'sold', 'cancelled']),
            ],
        ];
    }

    private function validateListing(array $data): void
    {
        $type = $data['listing_type'] ?? 'vehicle';
        $vehicleId = $data['vehicle_id'] ?? null;
        $antiqueId = $data['antique_id'] ?? null;

        if ($type === 'vehicle' && (!$vehicleId || $antiqueId)) {
            throw ValidationException::withMessages([
                'vehicle_id' => 'A vehicle auction must have a vehicle_id and no antique_id.',
            ]);
        }

        if ($type === 'antique' && (!$antiqueId || $vehicleId)) {
            throw ValidationException::withMessages([
                'antique_id' => 'An antique auction must have an antique_id and no vehicle_id.',
            ]);
        }
    }

    private function validateSchedule(array $data): void
    {
        if (
            !empty($data['starts_at']) &&
            !empty($data['ends_at']) &&
            strtotime($data['ends_at']) <= strtotime($data['starts_at'])
        ) {
            throw ValidationException::withMessages([
                'ends_at' => 'The end time must be after the start time.',
            ]);
        }
    }

    private function validatePricing(array $data): void
    {
        if (
            !empty($data['reserve_price']) &&
            (float) $data['reserve_price'] < (float) ($data['starting_bid'] ?? 0)
        ) {
            throw ValidationException::withMessages([
                'reserve_price' => 'The reserve price should not be lower than the starting bid.',
            ]);
        }

        if (!empty($data['buy_now_enabled']) && empty($data['buy_now_price'])) {
            throw ValidationException::withMessages([
                'buy_now_price' => 'A buy-now price is required when buy-now is enabled.',
            ]);
        }

        if (
            !empty($data['buy_now_price']) &&
            (float) $data['buy_now_price'] < (float) ($data['starting_bid'] ?? 0)
        ) {
            throw ValidationException::withMessages([
                'buy_now_price' => 'The buy-now price must be at least the starting bid.',
            ]);
        }
    }
}