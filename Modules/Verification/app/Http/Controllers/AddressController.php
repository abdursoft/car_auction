<?php

namespace Modules\Verification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Modules\Verification\Models\Address;

class AddressController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $addresses = $request->user()
            ->addresses()
            ->latest()
            ->paginate(15);

        return response()->json($addresses);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'address_type' => [
                'sometimes',
                Rule::in(['shipping', 'billing', 'residential', 'business']),
            ],
            'recipient_name' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state_province' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'country' => ['required', 'string', 'size:2'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'is_default_shipping' => ['sometimes', 'boolean'],
            'is_default_billing' => ['sometimes', 'boolean'],
            'delivery_instructions' => ['nullable', 'string', 'max:5000'],
        ]);

        $user = $request->user();

        $address = DB::transaction(function () use ($user, $validated) {
            // If either default is requested, clear that default from
            // the user's other addresses before creating this address.
            if ($validated['is_default_shipping'] ?? false) {
                $user->addresses()
                    ->where('is_default_shipping', true)
                    ->update(['is_default_shipping' => false]);
            }

            if ($validated['is_default_billing'] ?? false) {
                $user->addresses()
                    ->where('is_default_billing', true)
                    ->update(['is_default_billing' => false]);
            }

            return $user->addresses()->create($validated);
        });

        return response()->json([
            'message' => 'Address created successfully.',
            'address' => $address,
        ], 201);
    }

    public function show(Request $request, string $id): JsonResponse
    {
        $address = $request->user()
            ->addresses()
            ->findOrFail($id);

        return response()->json(['address' => $address]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $user = $request->user();

        $address = $user->addresses()->findOrFail($id);

        $validated = $request->validate([
            'address_type' => [
                'sometimes',
                Rule::in(['shipping', 'billing', 'residential', 'business']),
            ],
            'recipient_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'company_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'phone_number' => ['sometimes', 'nullable', 'string', 'max:30'],
            'address_line_1' => ['sometimes', 'required', 'string', 'max:255'],
            'address_line_2' => ['sometimes', 'nullable', 'string', 'max:255'],
            'district' => ['sometimes', 'nullable', 'string', 'max:255'],
            'city' => ['sometimes', 'required', 'string', 'max:255'],
            'state_province' => ['sometimes', 'nullable', 'string', 'max:255'],
            'postal_code' => ['sometimes', 'nullable', 'string', 'max:20'],
            'country' => ['sometimes', 'required', 'string', 'size:2'],
            'latitude' => ['sometimes', 'nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['sometimes', 'nullable', 'numeric', 'between:-180,180'],
            'is_default_shipping' => ['sometimes', 'boolean'],
            'is_default_billing' => ['sometimes', 'boolean'],
            'delivery_instructions' => ['sometimes', 'nullable', 'string', 'max:5000'],
        ]);

        DB::transaction(function () use ($user, $address, $validated) {
            if ($validated['is_default_shipping'] ?? false) {
                $user->addresses()
                    ->where('id', '!=', $address->id)
                    ->where('is_default_shipping', true)
                    ->update(['is_default_shipping' => false]);
            }

            if ($validated['is_default_billing'] ?? false) {
                $user->addresses()
                    ->where('id', '!=', $address->id)
                    ->where('is_default_billing', true)
                    ->update(['is_default_billing' => false]);
            }

            $address->update($validated);
        });

        return response()->json([
            'message' => 'Address updated successfully.',
            'address' => $address->fresh(),
        ]);
    }

    public function destroy(Request $request, string $id): JsonResponse
    {
        $address = $request->user()
            ->addresses()
            ->findOrFail($id);

        $address->delete();

        return response()->json([
            'message' => 'Address deleted successfully.',
        ]);
    }
}