<?php

namespace Modules\Car\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Car\Models\Vehicle;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::query()
            ->with(['brand', 'vehicleModel', 'category'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('vin', 'like', "%{$search}%")
                        ->orWhere('trim', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('brand_id'), fn ($q) =>
                $q->where('brand_id', $request->input('brand_id'))
            )
            ->when($request->filled('vehicle_model_id'), fn ($q) =>
                $q->where('vehicle_model_id', $request->input('vehicle_model_id'))
            )
            ->when($request->filled('category_id'), fn ($q) =>
                $q->where('category_id', $request->input('category_id'))
            )
            ->when($request->filled('year'), fn ($q) =>
                $q->where('year', $request->integer('year'))
            )
            ->when($request->filled('min_year'), fn ($q) =>
                $q->where('year', '>=', $request->integer('min_year'))
            )
            ->when($request->filled('max_year'), fn ($q) =>
                $q->where('year', '<=', $request->integer('max_year'))
            )
            ->when($request->filled('condition'), fn ($q) =>
                $q->where('condition', $request->input('condition'))
            )
            ->when($request->filled('fuel_type'), fn ($q) =>
                $q->where('fuel_type', $request->input('fuel_type'))
            )
            ->when($request->filled('transmission'), fn ($q) =>
                $q->where('transmission', $request->input('transmission'))
            )
            ->latest()
            ->paginate(min(max($request->integer('per_page', 15), 1), 100))
            ->withQueryString();

        return response()->json($vehicles);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $vehicle = Vehicle::create($validated);

        return response()->json([
            'message' => 'Vehicle created successfully.',
            'data' => $vehicle->load(['brand', 'vehicleModel', 'category']),
        ], 201);
    }

    public function show(Vehicle $vehicle)
    {
        return response()->json([
            'data' => $vehicle->load([
                'brand',
                'vehicleModel',
                'category',
                'auctions',
            ]),
        ]);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate($this->rules(true));

        $vehicle->update($validated);

        return response()->json([
            'message' => 'Vehicle updated successfully.',
            'data' => $vehicle->fresh()->load([
                'brand',
                'vehicleModel',
                'category',
            ]),
        ]);
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->auctions()->exists()) {
            return response()->json([
                'message' => 'This vehicle is linked to auctions and cannot be deleted.',
            ], 422);
        }

        $vehicle->delete();

        return response()->json([
            'message' => 'Vehicle deleted successfully.',
        ]);
    }

    private function rules(bool $isUpdate = false): array
    {
        $required = $isUpdate ? 'sometimes|required' : 'required';

        return [
            'vin' => ['nullable', 'string', 'max:255'],
            'year' => [$required, 'integer', 'min:1886', 'max:' . (date('Y') + 1)],
            'trim' => ['nullable', 'string', 'max:255'],

            'brand_id' => [
                $required,
                'uuid',
                Rule::exists('brands', 'id')->whereNull('deleted_at'),
            ],
            'vehicle_model_id' => [
                'nullable',
                'uuid',
                Rule::exists('vehicle_models', 'id')->whereNull('deleted_at'),
            ],
            'category_id' => [
                $required,
                'uuid',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
            ],

            'mileage' => ['nullable', 'integer', 'min:0'],
            'engine_type' => ['nullable', 'string', 'max:255'],
            'transmission' => ['nullable', 'string', 'max:255'],
            'drivetrain' => ['nullable', 'string', 'max:255'],
            'exterior_color' => ['nullable', 'string', 'max:255'],
            'interior_color' => ['nullable', 'string', 'max:255'],
            'fuel_type' => ['nullable', 'string', 'max:255'],
            'vehicle_type' => ['nullable', 'string', 'max:255'],

            'condition' => [
                'nullable',
                Rule::in(['excellent', 'good', 'fair', 'poor']),
            ],

            'has_keys' => ['nullable', 'boolean'],
            'engine_starts' => ['nullable', 'boolean'],
            'drivetrain_operational' => ['nullable', 'boolean'],
            'transmission_operational' => ['nullable', 'boolean'],
            'tire_condition' => [
                'nullable',
                Rule::in(['new', 'good', 'worn']),
            ],
            'frame_damage' => ['nullable', 'boolean'],

            'primary_damage' => ['nullable', 'string', 'max:255'],
            'secondary_damage' => ['nullable', 'string', 'max:255'],
            'loss_type' => ['nullable', 'string', 'max:255'],
            'title_status' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}