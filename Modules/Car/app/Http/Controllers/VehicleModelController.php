<?php

namespace Modules\Car\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Modules\Car\Models\VehicleModel;

class VehicleModelController extends Controller
{
    public function index(Request $request)
    {
        $vehicleModels = VehicleModel::query()
            ->with(['brand', 'category'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('brand_id'), function ($query) use ($request) {
                $query->where('brand_id', $request->input('brand_id'));
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->when($request->has('is_active'), function ($query) use ($request) {
                $query->where('is_active', $request->boolean('is_active'));
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(min(max((int) $request->input('per_page', 15), 1), 100))
            ->withQueryString();

        return response()->json($vehicleModels);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => [
                'required',
                'uuid',
                Rule::exists('brands', 'id')->whereNull('deleted_at'),
            ],
            'category_id' => [
                'nullable',
                'uuid',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
            ],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'start_year' => ['nullable', 'integer', 'min:1886', 'max:2200'],
            'end_year' => ['nullable', 'integer', 'min:1886', 'max:2200'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
        ]);

        $validated['slug'] = Str::slug(
            $validated['slug'] ?? $validated['name']
        );

        $this->validateYearRange(
            $validated['start_year'] ?? null,
            $validated['end_year'] ?? null
        );

        $request->validate([
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('vehicle_models', 'slug')
                    ->where('brand_id', $validated['brand_id']),
            ],
        ]);

        $vehicleModel = VehicleModel::create($validated);

        return response()->json([
            'message' => 'Vehicle model created successfully.',
            'data' => $vehicleModel->load(['brand', 'category']),
        ], 201);
    }

    public function show(VehicleModel $vehicleModel)
    {
        return response()->json([
            'data' => $vehicleModel->load(['brand', 'category']),
        ]);
    }

    public function update(Request $request, VehicleModel $vehicleModel)
    {
        $validated = $request->validate([
            'brand_id' => [
                'sometimes',
                'required',
                'uuid',
                Rule::exists('brands', 'id')->whereNull('deleted_at'),
            ],
            'category_id' => [
                'sometimes',
                'nullable',
                'uuid',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
            ],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'nullable', 'string', 'max:255'],
            'start_year' => ['sometimes', 'nullable', 'integer', 'min:1886', 'max:2200'],
            'end_year' => ['sometimes', 'nullable', 'integer', 'min:1886', 'max:2200'],
            'description' => ['sometimes', 'nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
        ]);

        $brandId = $validated['brand_id'] ?? $vehicleModel->brand_id;

        if (array_key_exists('slug', $validated) && $validated['slug'] === null) {
            $validated['slug'] = $validated['name'] ?? $vehicleModel->name;
        }

        if (array_key_exists('name', $validated) && !array_key_exists('slug', $validated)) {
            $validated['slug'] = $validated['name'];
        }

        if (isset($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);

            $request->validate([
                'slug' => [
                    'nullable',
                    'string',
                    'max:255',
                    Rule::unique('vehicle_models', 'slug')
                        ->where('brand_id', $brandId)
                        ->ignore($vehicleModel->id, 'id'),
                ],
            ]);
        }

        $this->validateYearRange(
            $validated['start_year'] ?? $vehicleModel->start_year,
            array_key_exists('end_year', $validated)
                ? $validated['end_year']
                : $vehicleModel->end_year
        );

        $vehicleModel->update($validated);

        return response()->json([
            'message' => 'Vehicle model updated successfully.',
            'data' => $vehicleModel->fresh()->load(['brand', 'category']),
        ]);
    }

    public function destroy(VehicleModel $vehicleModel)
    {
        if ($vehicleModel->vehicles()->exists()) {
            return response()->json([
                'message' => 'This model is associated with vehicles and cannot be deleted.',
            ], 422);
        }

        $vehicleModel->delete();

        return response()->json([
            'message' => 'Vehicle model deleted successfully.',
        ]);
    }

    private function validateYearRange(
        ?int $startYear,
        ?int $endYear
    ): void {
        if ($startYear !== null && $endYear !== null && $endYear < $startYear) {
            throw ValidationException::withMessages([
                'end_year' => 'The end year must be greater than or equal to the start year.',
            ]);
        }
    }
}