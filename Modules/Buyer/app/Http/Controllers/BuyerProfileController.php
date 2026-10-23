<?php

namespace Modules\Buyer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BuyerProfileController extends Controller
{
    /**
     * Display the authenticated user's buyer profile.
     */
    public function show(Request $request): JsonResponse
    {
        $profile = $request->user()
            ->buyerProfile()
            ->first();

        if (! $profile) {
            return response()->json([
                'message' => 'Buyer profile not found.',
            ], 404);
        }

        return response()->json([
            'data' => $profile,
        ]);
    }

    /**
     * Create the authenticated user's buyer profile.
     */
    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->buyerProfile()->exists()) {
            return response()->json([
                'message' => 'A buyer profile already exists.',
            ], 409);
        }

        $validated = $request->validate(
            $this->rules()
        );

        $profile = $user->buyerProfile()->create([
            ...$validated,
            'profile_completed' => false,
        ]);

        return response()->json([
            'message' => 'Buyer profile created successfully.',
            'data' => $profile,
        ], 201);
    }

    /**
     * Update the authenticated user's buyer profile.
     */
    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        $profile = $user->buyerProfile()->first();

        if (! $profile) {
            return response()->json([
                'message' => 'Buyer profile not found.',
            ], 404);
        }

        $validated = $request->validate(
            $this->rules()
        );

        $profile->fill($validated);

        // Recalculate readiness instead of trusting client input.
        $profile->profile_completed = $this->isProfileComplete(
            $profile->toArray()
        );

        $profile->save();

        return response()->json([
            'message' => 'Buyer profile updated successfully.',
            'data' => $profile->fresh(),
        ]);
    }

    /**
     * Validation rules for buyer profile fields.
     */
    private function rules(): array
    {
        return [
            'first_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'middle_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'last_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'display_name' => ['sometimes', 'nullable', 'string', 'max:255'],

            // Store a path or URL here; upload handling is separate.
            'profile_photo' => ['sometimes', 'nullable', 'string', 'max:2048'],

            'date_of_birth' => [
                'sometimes',
                'nullable',
                'date',
                'before:today',
            ],

            'gender' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],

            'phone_number' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],

            'alternate_phone_number' => [
                'sometimes',
                'nullable',
                'string',
                'max:30',
            ],

            'preferred_language' => [
                'sometimes',
                'nullable',
                'string',
                'max:10',
            ],

            'timezone' => [
                'sometimes',
                'nullable',
                'timezone',
            ],

            'buyer_type' => [
                'sometimes',
                'required',
                Rule::in(['individual', 'business', 'dealer']),
            ],

            'company_name' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'business_registration_number' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'tax_identification_number' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'preferred_currency' => [
                'sometimes',
                'string',
                'size:3',
                'regex:/^[A-Z]{3}$/',
            ],

            'email_notifications' => [
                'sometimes',
                'boolean',
            ],

            'sms_notifications' => [
                'sometimes',
                'boolean',
            ],

            'marketing_notifications' => [
                'sometimes',
                'boolean',
            ],
        ];
    }

    /**
     * Basic profile readiness check.
     */
    private function isProfileComplete(array $profile): bool
    {
        return filled($profile['first_name'] ?? null)
            && filled($profile['last_name'] ?? null)
            && filled($profile['phone_number'] ?? null)
            && filled($profile['buyer_type'] ?? null)
            && (
                ($profile['buyer_type'] ?? null) === 'individual'
                || filled($profile['company_name'] ?? null)
            );
    }
}