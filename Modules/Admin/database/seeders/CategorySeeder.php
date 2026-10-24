<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Admin\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Car categories
            [
                'name' => 'Exotic Supercars',
                'slug' => 'exotic-supercars',
                'icon' => 'Zap',
                'type' => 'car',
            ],
            [
                'name' => 'Classic Muscle',
                'slug' => 'classic-muscle',
                'icon' => 'Flame',
                'type' => 'car',
            ],
            [
                'name' => 'Luxury Sedans',
                'slug' => 'luxury-sedans',
                'icon' => 'Crown',
                'type' => 'car',
            ],
            [
                'name' => 'Off-Road & SUVs',
                'slug' => 'off-road-suvs',
                'icon' => 'Mountain',
                'type' => 'car',
            ],
            [
                'name' => 'Classic Cars',
                'slug' => 'classic-cars',
                'icon' => 'CarFront',
                'type' => 'car',
            ],
            [
                'name' => 'Electric Vehicles',
                'slug' => 'electric-vehicles',
                'icon' => 'BatteryCharging',
                'type' => 'car',
            ],

            // Antique categories
            [
                'name' => 'Antique Furniture',
                'slug' => 'antique-furniture',
                'icon' => 'Armchair',
                'type' => 'antique',
            ],
            [
                'name' => 'Art & Paintings',
                'slug' => 'art-paintings',
                'icon' => 'Palette',
                'type' => 'antique',
            ],
            [
                'name' => 'Coins & Currency',
                'slug' => 'coins-currency',
                'icon' => 'Coins',
                'type' => 'antique',
            ],
            [
                'name' => 'Jewelry & Watches',
                'slug' => 'jewelry-watches',
                'icon' => 'Watch',
                'type' => 'antique',
            ],
            [
                'name' => 'Vintage Books & Manuscripts',
                'slug' => 'vintage-books-manuscripts',
                'icon' => 'BookOpen',
                'type' => 'antique',
            ],
            [
                'name' => 'Ceramics & Porcelain',
                'slug' => 'ceramics-porcelain',
                'icon' => 'Coffee',
                'type' => 'antique',
            ],
            [
                'name' => 'Antique Clocks',
                'slug' => 'antique-clocks',
                'icon' => 'Clock',
                'type' => 'antique',
            ],
            [
                'name' => 'Collectibles & Memorabilia',
                'slug' => 'collectibles-memorabilia',
                'icon' => 'Trophy',
                'type' => 'antique',
            ],
            [
                'name' => 'Antique Lighting',
                'slug' => 'antique-lighting',
                'icon' => 'Lamp',
                'type' => 'antique',
            ],
            [
                'name' => 'Sculptures & Decorative Arts',
                'slug' => 'sculptures-decorative-arts',
                'icon' => 'Shapes',
                'type' => 'antique',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}