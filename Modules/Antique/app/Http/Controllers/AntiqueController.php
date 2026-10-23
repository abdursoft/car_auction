<?php

namespace Modules\Antique\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Modules\Antique\Models\Antique;

class AntiqueController extends Controller
{
    public function index(Request $request)
    {
        $antiques = Antique::query()
            ->with('materials')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('maker', 'like', "%{$search}%")
                        ->orWhere('material', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(min((int) $request->input('per_page', 15), 100))
            ->withQueryString();

        return response()->json($antiques);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'maker' => ['nullable', 'string', 'max:255'],
            'estimated_year' => [
                'nullable',
                'integer',
                'min:1',
                'max:' . date('Y'),
            ],
            'material' => ['nullable', 'string', 'max:255'],
            'provenance' => ['nullable', 'string'],
            'condition_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'material_ids' => ['sometimes', 'array'],
            'material_ids.*' => [
                'required',
                'uuid',
                Rule::exists('antique_materials', 'id')
                    ->whereNull('deleted_at'),
            ],
        ]);

        $antique = DB::transaction(function () use ($validated) {
            $materialIds = $validated['material_ids'] ?? [];
            unset($validated['material_ids']);

            $antique = Antique::create($validated);

            if (array_key_exists('material_ids', func_get_args())) {
                // Material syncing is handled below outside this branch.
            }

            $antique->materials()->sync($materialIds);

            return $antique;
        });

        return response()->json([
            'message' => 'Antique created successfully.',
            'data' => $antique->load('materials'),
        ], 201);
    }

    public function show(Antique $antique)
    {
        return response()->json([
            'data' => $antique->load('materials', 'auctions'),
        ]);
    }

    public function update(Request $request, Antique $antique)
    {
        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'maker' => ['sometimes', 'nullable', 'string', 'max:255'],
            'estimated_year' => [
                'sometimes',
                'nullable',
                'integer',
                'min:1',
                'max:' . date('Y'),
            ],
            'material' => ['sometimes', 'nullable', 'string', 'max:255'],
            'provenance' => ['sometimes', 'nullable', 'string'],
            'condition_description' => ['sometimes', 'nullable', 'string'],
            'description' => ['sometimes', 'nullable', 'string'],
            'material_ids' => ['sometimes', 'array'],
            'material_ids.*' => [
                'required',
                'uuid',
                Rule::exists('antique_materials', 'id')
                    ->whereNull('deleted_at'),
            ],
        ]);

        DB::transaction(function () use ($validated, $antique) {
            if (array_key_exists('material_ids', $validated)) {
                $antique->materials()->sync($validated['material_ids']);
                unset($validated['material_ids']);
            }

            $antique->update($validated);
        });

        return response()->json([
            'message' => 'Antique updated successfully.',
            'data' => $antique->fresh()->load('materials'),
        ]);
    }

    public function destroy(Antique $antique)
    {
        if ($antique->auctions()->exists()) {
            return response()->json([
                'message' => 'This antique is linked to auctions and cannot be deleted.',
            ], 422);
        }

        $antique->delete();

        return response()->json([
            'message' => 'Antique deleted successfully.',
        ]);
    }
}
