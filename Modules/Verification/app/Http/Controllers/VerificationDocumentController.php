<?php

namespace Modules\Verification\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\Verification\Models\Verification;
use Modules\Verification\Models\VerificationDocument;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VerificationDocumentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $documents = VerificationDocument::query()
            ->where('user_id', $request->user()->id)
            ->select([
                'id',
                'user_id',
                'verification_id',
                'document_type',
                'original_filename',
                'mime_type',
                'file_size',
                'document_side',
                'status',
                'uploaded_at',
                'reviewed_at',
                'rejection_reason',
                'created_at',
            ])
            ->latest()
            ->paginate(15);

        return response()->json($documents);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'verification_id' => [
                'nullable',
                'uuid',
                Rule::exists('verifications', 'id')
                    ->where('user_id', $request->user()->id),
            ],
            'document_type' => [
                'required',
                Rule::in([
                    'passport',
                    'national_id',
                    'driving_license',
                    'proof_of_address',
                    'business_license',
                    'tax_certificate',
                    'other',
                ]),
            ],
            'document_side' => [
                'nullable',
                Rule::in(['front', 'back', 'single', 'supporting']),
            ],
            'document' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:10240', // 10 MB
            ],
        ]);

        $file = $request->file('document');
        $user = $request->user();

        // Store with a generated filename, not the user's filename.
        $path = $file->store(
            'verification-documents/' . $user->id,
            'private'
        );

        if ($path === false) {
            return response()->json([
                'message' => 'The document could not be stored.',
            ], 500);
        }

        $document = VerificationDocument::create([
            'user_id' => $user->id,
            'verification_id' => $validated['verification_id'] ?? null,
            'document_type' => $validated['document_type'],
            'document_side' => $validated['document_side'] ?? null,
            'original_filename' => Str::limit(
                basename($file->getClientOriginalName()),
                255,
                ''
            ),
            'storage_disk' => 'private',
            'storage_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'file_hash' => hash_file(
                'sha256',
                $file->getRealPath()
            ),
            'status' => 'uploaded',
            'uploaded_at' => now(),
        ]);

        return response()->json([
            'message' => 'Document uploaded successfully.',
            'document' => $document->makeVisible([
                'storage_path',
                'file_hash',
            ])->only([
                'id',
                'verification_id',
                'document_type',
                'document_side',
                'original_filename',
                'mime_type',
                'file_size',
                'status',
                'uploaded_at',
            ]),
        ], 201);
    }

    public function download(Request $request, string $id): StreamedResponse
    {
        $document = VerificationDocument::query()
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        abort_unless(
            Storage::disk($document->storage_disk)
                ->exists($document->storage_path),
            404
        );

        return Storage::disk($document->storage_disk)->download(
            $document->storage_path,
            $document->original_filename ?: 'verification-document'
        );
    }
}