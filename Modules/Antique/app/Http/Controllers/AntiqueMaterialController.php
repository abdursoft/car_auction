<?php

namespace Modules\Antique\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\Antique\Models\AntiqueMaterial;

class AntiqueMaterialController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = AntiqueMaterial::query()
            ->orderBy('sort_order')
            ->orderBy('name');

        if ($request->boolean('active_only')) {
            $query->where('is_active', true);
        }

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        return response()->json($query->paginate(15));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:antique_materials,name'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:antique_materials,slug'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
            'antique_id' => [
                'required',
                'uuid',
                Rule::exists('antiques', 'id')
                    ->whereNull('deleted_at'),
            ],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        validator($validated, [
            'slug' => ['required', 'string', 'max:255', 'unique:antique_materials,slug'],
        ])->validate();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('antique-materials', 'public');
        }

        $material = AntiqueMaterial::create($validated);

        return response()->json([
            'message' => 'Antique material created successfully.',
            'data' => $material,
        ], 201);
    }

    public function show(AntiqueMaterial $antiqueMaterial): JsonResponse
    {
        return response()->json([
            'data' => $antiqueMaterial,
        ]);
    }

    public function update(
        Request $request,
        AntiqueMaterial $antiqueMaterial
    ): JsonResponse {
        $validated = $request->validate([
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('antique_materials', 'name')
                    ->ignore($antiqueMaterial->id, 'id'),
            ],
            'slug' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('antique_materials', 'slug')
                    ->ignore($antiqueMaterial->id, 'id'),
            ],
            'description' => ['sometimes', 'nullable', 'string'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
            'antique_id' => [
                'sometimes',
                'required',
                'uuid',
                Rule::exists('antiques', 'id')
                    ->whereNull('deleted_at'),
            ],
        ]);

        if ($request->hasFile('image')) {
            if ($antiqueMaterial->image) {
                Storage::disk('public')->delete($antiqueMaterial->image);
            }

            $validated['image'] = $request->file('image')
                ->store('antique-materials', 'public');
        }

        $antiqueMaterial->update($validated);

        return response()->json([
            'message' => 'Antique material updated successfully.',
            'data' => $antiqueMaterial->fresh(),
        ]);
    }

    public function destroy(AntiqueMaterial $antiqueMaterial): JsonResponse
    {
        if ($antiqueMaterial->antiques()->exists()) {
            return response()->json([
                'message' => 'This material is assigned to antiques. Remove its associations before deleting it.',
            ], 409);
        }

        $antiqueMaterial->delete();

        return response()->json([
            'message' => 'Antique material deleted successfully.',
        ]);
    }
}