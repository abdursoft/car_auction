<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Admin\Models\Brand;
use Modules\Admin\Models\Category;
use Modules\Car\Models\Vehicle;
use Modules\Car\Models\VehicleModel;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            [
                'stock' => '38492011',
                'vin' => '1N4AL3APXFC123456',
                'make' => 'Nissan',
                'model' => 'Altima',
                'category' => 'Luxury Sedans',
                'year' => 2023,
                'mileage' => 12450,
                'damage' => 'Front End',
                'loss' => 'Collision',
                'title' => 'Salvage Title',
                'keys' => true,
                'starts' => true,
                'price' => 5400,
                'image' => 'https://placehold.co/1200x800?text=Nissan+Altima',
                'gallery' => [],
            ],
            [
                'stock' => '39502122',
                'vin' => 'WBA53AG00LG789012',
                'make' => 'BMW',
                'model' => 'M3',
                'category' => 'Classic Muscle',
                'year' => 2021,
                'mileage' => 45200,
                'damage' => 'Rear End',
                'loss' => 'Collision',
                'title' => 'Clear Title',
                'keys' => true,
                'starts' => false,
                'price' => 28000,
                'image' => 'https://placehold.co/1200x800?text=BMW+M3',
                'gallery' => [],
            ],
            [
                'stock' => '40613233',
                'vin' => 'WP0AB2A99KS123456',
                'make' => 'Porsche',
                'model' => '911 Carrera',
                'category' => 'Exotic Supercars',
                'year' => 2019,
                'mileage' => 21800,
                'damage' => 'Minor Dent/Scratches',
                'loss' => 'Other',
                'title' => 'Clear Title',
                'keys' => true,
                'starts' => true,
                'price' => 68500,
                'image' => 'https://placehold.co/1200x800?text=Porsche+911',
                'gallery' => [],
            ],
            [
                'stock' => '41724344',
                'vin' => 'ZFF92LLA7N0123456',
                'make' => 'Ferrari',
                'model' => 'SF90 Stradale',
                'category' => 'Exotic Supercars',
                'year' => 2022,
                'mileage' => 6800,
                'damage' => 'Front End',
                'loss' => 'Collision',
                'title' => 'Salvage Title',
                'keys' => true,
                'starts' => false,
                'price' => 145000,
                'image' => 'https://placehold.co/1200x800?text=Ferrari+SF90',
                'gallery' => [],
            ],
            [
                'stock' => '42835455',
                'vin' => '1FA6P8CF5M5123456',
                'make' => 'Ford',
                'model' => 'Mustang GT',
                'category' => 'Classic Muscle',
                'year' => 2021,
                'mileage' => 32000,
                'damage' => 'Side',
                'loss' => 'Collision',
                'title' => 'Clear Title',
                'keys' => true,
                'starts' => true,
                'price' => 19500,
                'image' => 'https://placehold.co/1200x800?text=Ford+Mustang',
                'gallery' => [],
            ],
            [
                'stock' => '43946566',
                'vin' => 'JTJAM7BX8M5123456',
                'make' => 'Toyota',
                'model' => 'Land Cruiser',
                'category' => 'Off-Road & SUVs',
                'year' => 2021,
                'mileage' => 28500,
                'damage' => 'Minor Dent/Scratches',
                'loss' => 'Other',
                'title' => 'Clear Title',
                'keys' => true,
                'starts' => true,
                'price' => 52000,
                'image' => 'https://placehold.co/1200x800?text=Toyota+Land+Cruiser',
                'gallery' => [],
            ],
            [
                'stock' => '44057677',
                'vin' => 'WDDZF4KB5KA123456',
                'make' => 'Mercedes-Benz',
                'model' => 'S-Class',
                'category' => 'Luxury Sedans',
                'year' => 2019,
                'mileage' => 51000,
                'damage' => 'Rear End',
                'loss' => 'Collision',
                'title' => 'Salvage Title',
                'keys' => true,
                'starts' => false,
                'price' => 22000,
                'image' => 'https://placehold.co/1200x800?text=Mercedes+S-Class',
                'gallery' => [],
            ],
            [
                'stock' => '45168788',
                'vin' => '5YJ3E1EA7KF123456',
                'make' => 'Tesla',
                'model' => 'Model 3',
                'category' => 'Electric Vehicles',
                'year' => 2019,
                'mileage' => 39500,
                'damage' => 'Front End',
                'loss' => 'Collision',
                'title' => 'Salvage Title',
                'keys' => true,
                'starts' => false,
                'price' => 8500,
                'image' => 'https://placehold.co/1200x800?text=Tesla+Model+3',
                'gallery' => [],
            ],
        ];

        foreach ($cars as $car) {
            $brand = Brand::firstOrCreate(
                ['name' => $car['make']],
                ['slug' => Str::slug($car['make'])]
            );

            $model = VehicleModel::firstOrCreate(
                [
                    'brand_id' => $brand->id,
                    'name' => $car['model'],
                ],
                ['slug' => Str::slug($car['model'])]
            );

            $category = Category::where('name', $car['category'])->first();

            if (! $category) {
                $this->command?->warn(
                    "Category not found: {$car['category']}. Skipping {$car['stock']}."
                );

                continue;
            }

            Vehicle::updateOrCreate(
                ['vin' => $car['vin']],
                [
                    'brand_id' => $brand->id,
                    'vehicle_model_id' => $model->id,
                    'category_id' => $category->id,
                    'year' => $car['year'],
                    'mileage' => $car['mileage'],
                    'has_keys' => $car['keys'],
                    'primary_damage' => $car['damage'],
                    'loss_type' => $car['loss'],
                    'title_status' => $car['title'],
                ]
            );
        }
    }
}
