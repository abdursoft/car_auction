<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\Admin\Models\Brand;

class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        $brands = Brand::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return response()->json($brands);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:brands,name'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:brands,slug'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'description' => ['nullable', 'string'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        // Also validate the generated slug for uniqueness.
        validator($validated, [
            'slug' => ['required', 'string', 'max:255', 'unique:brands,slug'],
        ])->validate();

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('brands', 'public');
        }

        $brand = Brand::create($validated);

        return response()->json([
            'message' => 'Brand created successfully.',
            'data' => $brand,
        ], 201);
    }

    public function show(Brand $brand): JsonResponse
    {
        return response()->json([
            'data' => $brand,
        ]);
    }

    public function update(Request $request, Brand $brand): JsonResponse
    {
        $validated = $request->validate([
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('brands', 'name')->ignore($brand->id, 'id'),
            ],
            'slug' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('brands', 'slug')->ignore($brand->id, 'id'),
            ],
            'logo' => ['sometimes', 'nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'description' => ['sometimes', 'nullable', 'string'],
            'website_url' => ['sometimes', 'nullable', 'url', 'max:255'],
            'is_featured' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('logo')) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('brands', 'public');
        }

        $brand->update($validated);

        return response()->json([
            'message' => 'Brand updated successfully.',
            'data' => $brand->fresh(),
        ]);
    }

    public function destroy(Brand $brand): JsonResponse
    {
        // Soft delete: the record is retained in the database.
        $brand->delete();

        return response()->json([
            'message' => 'Brand deleted successfully.',
        ]);
    }
}