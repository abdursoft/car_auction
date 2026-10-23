<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Category::query()
            ->with('parent:id,name')
            ->withCount('children')
            ->orderBy('sort_order')
            ->orderBy('name');

        if ($request->boolean('active_only')) {
            $query->where('is_active', true);
        }

        if ($request->boolean('root_only')) {
            $query->whereNull('parent_id');
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
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'parent_id' => [
                'nullable',
                'uuid',
                Rule::exists('categories', 'id')
                    ->whereNull('deleted_at'),
            ],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:320'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        validator($validated, [
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],
        ])->validate();

        $category = DB::transaction(
            fn () => Category::create($validated)
        );

        return response()->json([
            'message' => 'Category created successfully.',
            'data' => $category->load('parent:id,name'),
        ], 201);
    }

    public function show(Category $category): JsonResponse
    {
        $category->load([
            'parent:id,name',
            'children',
        ]);

        return response()->json([
            'data' => $category,
        ]);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category->id, 'id'),
            ],
            'description' => ['sometimes', 'nullable', 'string'],
            'icon' => ['sometimes', 'nullable', 'string', 'max:255'],
            'parent_id' => [
                'sometimes',
                'nullable',
                'uuid',
                Rule::exists('categories', 'id')
                    ->whereNull('deleted_at'),
            ],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'meta_title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'meta_description' => ['sometimes', 'nullable', 'string', 'max:320'],
        ]);

        if (array_key_exists('parent_id', $validated)) {
            $parentId = $validated['parent_id'];

            if ($parentId === $category->id) {
                return response()->json([
                    'message' => 'A category cannot be its own parent.',
                ], 422);
            }

            if ($parentId && $this->isDescendant($category, $parentId)) {
                return response()->json([
                    'message' => 'A category cannot be moved under one of its descendants.',
                ], 422);
            }
        }

        if (
            isset($validated['name'])
            && ! array_key_exists('slug', $validated)
        ) {
            $validated['slug'] = Str::slug($validated['name']);

            validator($validated, [
                'slug' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories', 'slug')->ignore($category->id, 'id'),
                ],
            ])->validate();
        }

        DB::transaction(fn () => $category->update($validated));

        return response()->json([
            'message' => 'Category updated successfully.',
            'data' => $category->fresh()->load('parent:id,name'),
        ]);
    }

    public function destroy(Category $category): JsonResponse
    {
        if ($category->children()->exists()) {
            return response()->json([
                'message' => 'Move or delete the child categories before deleting this category.',
            ], 409);
        }

        if (
            $category->vehicleModels()->exists()
            || $category->vehicles()->exists()
            || $category->antiques()->exists()
        ) {
            return response()->json([
                'message' => 'This category is in use and cannot be deleted.',
            ], 409);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.',
        ]);
    }

    private function isDescendant(Category $category, string $candidateId): bool
    {
        $children = Category::query()
            ->where('parent_id', $category->id)
            ->pluck('id');

        if ($children->contains($candidateId)) {
            return true;
        }

        foreach ($children as $childId) {
            $child = Category::find($childId);

            if ($child && $this->isDescendant($child, $candidateId)) {
                return true;
            }
        }

        return false;
    }
}