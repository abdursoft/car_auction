<?php
namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            // Featured Supercar Brands
            ['name' => 'Porsche', 'is_featured' => true, 'website' => 'https://www.porsche.com'],
            ['name' => 'Ferrari', 'is_featured' => true, 'website' => 'https://www.ferrari.com'],
            ['name' => 'Lamborghini', 'is_featured' => true, 'website' => 'https://www.lamborghini.com'],
            ['name' => 'McLaren', 'is_featured' => true, 'website' => 'https://www.mclaren.com'],
            
            // Luxury & Performance
            ['name' => 'BMW', 'is_featured' => false, 'website' => 'https://www.bmw.com'],
            ['name' => 'Mercedes-Benz', 'is_featured' => false, 'website' => 'https://www.mercedes-benz.com'],
            ['name' => 'Audi', 'is_featured' => false, 'website' => 'https://www.audi.com'],
            ['name' => 'Aston Martin', 'is_featured' => false, 'website' => 'https://www.astonmartin.com'],
            
            // Enthusiast & JDM
            ['name' => 'Toyota', 'is_featured' => false, 'website' => 'https://www.toyota.com'],
            ['name' => 'Nissan', 'is_featured' => false, 'website' => 'https://www.nissan-global.com'],
            ['name' => 'Ford', 'is_featured' => false, 'website' => 'https://www.ford.com'],
            ['name' => 'Chevrolet', 'is_featured' => false, 'website' => 'https://www.chevrolet.com'],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['name' => $brand['name']],
                [
                    'slug' => Str::slug($brand['name']),
                    'is_featured' => $brand['is_featured'],
                    'website_url' => $brand['website'],
                    // Note: Logos would typically be uploaded to storage/brands/
                    'logo' => 'logos/' . Str::slug($brand['name']) . '.svg',
                ]
            );
        }
    }
}