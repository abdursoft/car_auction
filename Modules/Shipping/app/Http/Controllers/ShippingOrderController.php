<?php

namespace Modules\Shipping\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Modules\Auction\Models\Auction;
use Modules\Shipping\Models\ShippingMethod;
use Modules\Shipping\Models\ShippingOrder;

class ShippingOrderController extends Controller
{
    /**
     * List orders belonging to the authenticated buyer or seller.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $orders = ShippingOrder::query()
            ->where(function ($query) use ($user) {
                $query->where('buyer_id', $user->id)
                    ->orWhere('seller_id', $user->id);
            })
            ->with([
                'auction:id,user_id',
                'shippingMethod:id,name,slug,provider_name,method_type',
            ])
            ->latest()
            ->paginate(15);

        return response()->json($orders);
    }

    /**
     * Show an order to its buyer or seller.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $user = $request->user();

        $order = ShippingOrder::query()
            ->where(function ($query) use ($user) {
                $query->where('buyer_id', $user->id)
                    ->orWhere('seller_id', $user->id);
            })
            ->with([
                'auction',
                'shippingMethod',
                'buyer:id,name,email',
                'seller:id,name,email',
            ])
            ->findOrFail($id);

        return response()->json([
            'shipping_order' => $order,
        ]);
    }

    /**
     * Create a shipping order for an auction won by the authenticated buyer.
     */
    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'auction_id' => [
                'required',
                'uuid',
                'exists:auctions,id',
            ],

            'delivery_method' => [
                'required',
                Rule::in(['shipping', 'pickup', 'local_delivery']),
            ],

            'shipping_method_id' => [
                'nullable',
                'required_if:delivery_method,shipping',
                'uuid',
                'exists:shipping_methods,id',
            ],

            // Must belong to the authenticated buyer.
            'address_id' => [
                'nullable',
                'required_if:delivery_method,shipping',
                'uuid',
                Rule::exists('addresses', 'id')
                    ->where('user_id', $user->id),
            ],

            'pickup_details' => ['nullable', 'array'],
            'pickup_details.location' => ['nullable', 'string', 'max:500'],
            'pickup_details.instructions' => ['nullable', 'string', 'max:2000'],
        ]);

        $order = DB::transaction(function () use ($validated, $user) {
            $auction = Auction::query()
                ->lockForUpdate()
                ->findOrFail($validated['auction_id']);

            if ((string) $auction->user_id === (string) $user->id) {
                abort(422, 'You cannot create a shipping order for your own auction.');
            }

            // Verify that this buyer won the auction.
            $wonAuction = DB::table('auction_results')
                ->where('auction_id', $auction->id)
                ->where('winning_user_id', $user->id)
                ->where('result', 'sold')
                ->exists();

            if (! $wonAuction) {
                abort(403, 'Only the winning buyer can create this shipping order.');
            }

            if (
                ShippingOrder::query()
                    ->where('auction_id', $auction->id)
                    ->exists()
            ) {
                abort(409, 'A shipping order already exists for this auction.');
            }

            $method = null;
            $addressSnapshot = null;
            $shippingCost = null;
            $methodName = null;
            $carrier = null;
            $serviceCode = null;

            if ($validated['delivery_method'] === 'shipping') {
                $method = ShippingMethod::query()
                    ->active()
                    ->findOrFail($validated['shipping_method_id']);

                $address = $user->addresses()
                    ->findOrFail($validated['address_id']);

                $addressSnapshot = [
                    'recipient_name' => $address->recipient_name,
                    'company_name' => $address->company_name,
                    'phone_number' => $address->phone_number,
                    'address_line_1' => $address->address_line_1,
                    'address_line_2' => $address->address_line_2,
                    'district' => $address->district,
                    'city' => $address->city,
                    'state_province' => $address->state_province,
                    'postal_code' => $address->postal_code,
                    'country' => $address->country,
                ];

                $methodName = $method->name;
                $carrier = $method->provider_name;
                $serviceCode = $method->service_code;

                // This is only a base-price snapshot, not a complete quote.
                // Replace with a server-side shipping quote service before
                // charging the buyer.
                $shippingCost = $method->requires_quote
                    ? null
                    : $method->base_price;
            }

            return ShippingOrder::create([
                'auction_id' => $auction->id,
                'buyer_id' => $user->id,
                'seller_id' => $auction->user_id,
                'shipping_method_id' => $method?->id,
                'delivery_method' => $validated['delivery_method'],
                'shipping_method_name' => $methodName,
                'carrier' => $carrier,
                'service_code' => $serviceCode,
                'status' => 'pending',
                'recipient_address' => $addressSnapshot,
                'pickup_details' => $validated['pickup_details'] ?? null,
                'shipping_cost' => $shippingCost,
                'currency' => $method?->currency ?? 'USD',
            ]);
        });

        return response()->json([
            'message' => 'Shipping order created successfully.',
            'shipping_order' => $order->load('shippingMethod'),
        ], 201);
    }

    /**
     * Seller updates tracking information and marks the order as shipped.
     */
    public function updateTracking(
        Request $request,
        string $id
    ): JsonResponse {
        $user = $request->user();

        $order = ShippingOrder::query()
            ->where('seller_id', $user->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'tracking_number' => ['required', 'string', 'max:255'],
            'tracking_url' => ['nullable', 'url', 'max:2048'],
        ]);

        if (! in_array($order->status, ['pending', 'preparing'], true)) {
            return response()->json([
                'message' => 'Tracking information cannot be changed at this stage.',
            ], 409);
        }

        $order->update([
            'tracking_number' => $validated['tracking_number'],
            'tracking_url' => $validated['tracking_url'] ?? null,
            'status' => 'shipped',
            'shipped_at' => now(),
        ]);

        return response()->json([
            'message' => 'Tracking information updated.',
            'shipping_order' => $order->fresh(),
        ]);
    }
}