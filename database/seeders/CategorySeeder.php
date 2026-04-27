<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Exotic Supercars', 'slug' => 'exotic-supercars', 'icon' => 'Zap'],
            ['name' => 'Classic Muscle', 'slug' => 'classic-muscle', 'icon' => 'Flame'],
            ['name' => 'Luxury Sedans', 'slug' => 'luxury-sedans', 'icon' => 'Crown'],
            ['name' => 'Off-Road & SUVs', 'slug' => 'off-road-suvs', 'icon' => 'Mountain'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create($cat);
        }
    }
}
