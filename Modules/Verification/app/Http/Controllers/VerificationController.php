<?php

namespace Modules\Verification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Verification\Models\Verification;

class VerificationController extends Controller
{
    /**
     * List the authenticated user's verification records.
     */
    public function index(Request $request): JsonResponse
    {
        $verifications = $request->user()
            ->verifications()
            ->select([
                'id',
                'user_id',
                'verification_type',
                'status',
                'country_of_residence',
                'nationality',
                'document_type',
                'issuing_country',
                'document_expiry_date',
                'submitted_at',
                'reviewed_at',
                'verified_at',
                'expires_at',
                'rejection_reason',
                'created_at',
                'updated_at',
            ])
            ->latest()
            ->paginate(20);

        return response()->json($verifications);
    }

    /**
     * Show one of the authenticated user's verification records.
     */
    public function show(
        Request $request,
        string $verification
    ): JsonResponse {
        $record = $request->user()
            ->verifications()
            ->select([
                'id',
                'user_id',
                'verification_type',
                'status',
                'country_of_residence',
                'nationality',
                'document_type',
                'issuing_country',
                'document_expiry_date',
                'submitted_at',
                'reviewed_at',
                'verified_at',
                'expires_at',
                'rejection_reason',
                'created_at',
                'updated_at',
            ])
            ->whereKey($verification)
            ->firstOrFail();

        return response()->json([
            'data' => $record,
        ]);
    }

    /**
     * Submit a verification request.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'verification_type' => [
                'required',
                Rule::in([
                    'identity',
                    'address',
                    'phone',
                    'email',
                    'business',
                    'tax',
                    'payment',
                ]),
            ],

            'legal_first_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'legal_middle_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'legal_last_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'country_of_residence' => [
                'nullable',
                'string',
                'size:2',
                'regex:/^[A-Za-z]{2}$/',
            ],
            'nationality' => [
                'nullable',
                'string',
                'size:2',
                'regex:/^[A-Za-z]{2}$/',
            ],

            'document_type' => [
                'nullable',
                Rule::in([
                    'passport',
                    'national_id',
                    'driving_license',
                    'residence_permit',
                ]),
            ],
            'issuing_country' => [
                'nullable',
                'string',
                'size:2',
                'regex:/^[A-Za-z]{2}$/',
            ],
            'document_number' => [
                'nullable',
                'string',
                'max:500',
            ],
            'document_expiry_date' => [
                'nullable',
                'date',
            ],
        ]);

        $user = $request->user();

        $existing = $user->verifications()
            ->where('verification_type', $validated['verification_type'])
            ->whereIn('status', [
                'pending',
                'submitted',
                'under_review',
                'approved',
            ])
            ->exists();

        if ($existing) {
            return response()->json([
                'message' => 'An active verification of this type already exists.',
            ], 409);
        }

        $documentNumber = $validated['document_number'] ?? null;
        unset($validated['document_number']);

        $record = $user->verifications()->create([
            ...$validated,
            'country_of_residence' => isset($validated['country_of_residence'])
                ? strtoupper($validated['country_of_residence'])
                : null,
            'nationality' => isset($validated['nationality'])
                ? strtoupper($validated['nationality'])
                : null,
            'issuing_country' => isset($validated['issuing_country'])
                ? strtoupper($validated['issuing_country'])
                : null,
            'document_number_encrypted' => $documentNumber,
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        return response()->json([
            'message' => 'Verification submitted successfully.',
            'data' => [
                'id' => $record->id,
                'verification_type' => $record->verification_type,
                'status' => $record->status,
                'submitted_at' => $record->submitted_at,
            ],
        ], 201);
    }
}