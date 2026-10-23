<?php
namespace Database\Seeders;

use App\Models\Car;
use App\Models\Brand;
use App\Models\VehicleModel;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        // Mock data from the eliteautoauctions IAAI feed
        $cars = [
            [
                'stock' => '38492011',
                'vin' => '1N4AL3APXFC123456',
                'make' => 'Nissan',
                'model' => 'Altima',
                'year' => 2023,
                'mileage' => '12,450',
                'damage' => 'Front End',
                'loss' => 'Collision',
                'title' => 'Salvage Title',
                'keys' => 'yes',
                'start' => 'yes',
                'price' => 5400,
                'image' => 'https://example.com/main.jpg',
                'gallery' => ['https://example.com/img1.jpg', 'https://example.com/img2.jpg']
            ],
            [
                'stock' => '39502122',
                'vin' => 'WBA53AG00LG789012',
                'make' => 'BMW',
                'model' => 'M3',
                'year' => 2021,
                'mileage' => '45,200',
                'damage' => 'Rear End',
                'loss' => 'Collision',
                'title' => 'Clear Title',
                'keys' => 'yes',
                'start' => 'no',
                'price' => 28000,
                'image' => 'https://example.com/bmw.jpg',
                'gallery' => []
            ]
        ];

        foreach ($cars as $car) {
            $brand = Brand::firstOrCreate(['name' => $car['make']], ['slug' => Str::slug($car['make'])]);
            
            $model = VehicleModel::firstOrCreate(
                ['name' => $car['model'], 'brand_id' => $brand->id],
                ['slug' => Str::slug($car['model'])]
            );

            // Assuming 'Sedan' or 'Supercars' category exists
            $category = Category::first(); 

            Car::updateOrCreate(
                ['stock_number' => $car['stock']],
                [
                    'vin' => $car['vin'],
                    'brand_id' => $brand->id,
                    'vehicle_model_id' => $model->id,
                    'category_id' => $category->id,
                    'year' => $car['year'],
                    'mileage' => $car['mileage'],
                    'image_url' => $car['image'],
                    'additional_images' => $car['gallery'],
                    
                    // Technical Status
                    'has_keys' => $car['keys'],
                    'engin_start' => $car['start'],
                    'primary_damage' => $car['damage'],
                    'loss_type' => $car['loss'],
                    'title_status' => $car['title'],
                    
                    // Auction Pricing
                    'starting_bid' => $car['price'],
                    'current_bid' => $car['price'],
                    'auction_date' => now()->addDays(rand(1, 10)),
                    'status' => 'upcoming',
                    'auction_type' => 'online',
                ]
            );
        }
    }
}