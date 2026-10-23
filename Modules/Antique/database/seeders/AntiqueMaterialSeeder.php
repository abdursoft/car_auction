<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Antique\Models\AntiqueMaterial;

class AntiqueMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $materials = [
            ['name' => 'Wood', 'description' => 'Natural wood used in antique furniture, carvings, and decorative objects.'],
            ['name' => 'Mahogany', 'description' => 'Hardwood commonly used in traditional and antique furniture.'],
            ['name' => 'Oak', 'description' => 'Durable hardwood used in furniture, cabinets, and decorative pieces.'],
            ['name' => 'Teak', 'description' => 'Durable hardwood used in furniture and traditional craftsmanship.'],
            ['name' => 'Rosewood', 'description' => 'Decorative hardwood used in fine furniture and musical instruments.'],
            ['name' => 'Bronze', 'description' => 'Copper alloy used in sculptures, ornaments, and historical artifacts.'],
            ['name' => 'Brass', 'description' => 'Copper and zinc alloy used in lamps, handles, clocks, and ornaments.'],
            ['name' => 'Copper', 'description' => 'Metal used in antique cookware, vessels, and decorative objects.'],
            ['name' => 'Iron', 'description' => 'Metal used in tools, hardware, furniture, and historical objects.'],
            ['name' => 'Silver', 'description' => 'Precious metal used in jewelry, tableware, and decorative antiques.'],
            ['name' => 'Sterling Silver', 'description' => 'Silver alloy traditionally used in fine tableware and ornaments.'],
            ['name' => 'Gold', 'description' => 'Precious metal used in jewelry, decorative objects, and gilding.'],
            ['name' => 'Porcelain', 'description' => 'Fine ceramic material used in antique dishes, figurines, and ornaments.'],
            ['name' => 'Ceramic', 'description' => 'Fired clay material used in pottery, tiles, vessels, and ornaments.'],
            ['name' => 'Terracotta', 'description' => 'Unglazed fired clay used in sculptures, pottery, and architectural objects.'],
            ['name' => 'Glass', 'description' => 'Material used in antique bottles, vessels, windows, and ornaments.'],
            ['name' => 'Crystal', 'description' => 'Decorative glass used in fine tableware and collectible objects.'],
            ['name' => 'Marble', 'description' => 'Natural stone used in sculptures, tabletops, and decorative objects.'],
            ['name' => 'Granite', 'description' => 'Natural stone used in historical objects and decorative pieces.'],
            ['name' => 'Jade', 'description' => 'Decorative gemstone used in carvings, ornaments, and jewelry.'],
            ['name' => 'Ivory Substitute', 'description' => 'Lawful alternative materials designed to resemble ivory.'],
            ['name' => 'Bone', 'description' => 'Animal bone historically used in carvings and decorative objects; verify provenance and applicable laws.'],
            ['name' => 'Leather', 'description' => 'Tanned hide used in antique furniture, accessories, and bookbinding.'],
            ['name' => 'Silk', 'description' => 'Natural textile fiber used in antique garments, tapestries, and furnishings.'],
            ['name' => 'Cotton', 'description' => 'Natural textile fiber used in vintage and antique fabrics.'],
            ['name' => 'Wool', 'description' => 'Natural fiber used in rugs, tapestries, and historical textiles.'],
            ['name' => 'Paper', 'description' => 'Material used in antique prints, documents, maps, and collectibles.'],
            ['name' => 'Parchment', 'description' => 'Prepared animal skin historically used for manuscripts and documents.'],
            ['name' => 'Enamel', 'description' => 'Decorative coating used on metal objects, jewelry, and collectible ornaments.'],
            ['name' => 'Mixed Materials', 'description' => 'Antiques made from multiple materials that are not represented by a single primary material.'],
        ];

        foreach ($materials as $index => $material) {
            $slug = Str::slug($material['name']);

            $record = AntiqueMaterial::withTrashed()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $material['name'],
                    'description' => $material['description'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]
            );

            if ($record->trashed()) {
                $record->restore();
            }
        }
    }
}