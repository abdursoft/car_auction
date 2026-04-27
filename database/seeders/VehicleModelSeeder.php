<?php
namespace Database\Seeders;

use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Database\Seeder;

class VehicleModelSeeder extends Seeder {
    public function run(): void {
        $data = [
            'Porsche' => ['911 Carrera', 'Cayman GT4', 'Taycan', '911 GT3 RS'],
            'BMW' => ['M3', 'M5', 'X5 M', 'i8'],
            'Ferrari' => ['488 Pista', 'SF90 Stradale', 'F8 Tributo', 'Roma'],
            'Lamborghini' => ['Aventador SVJ', 'Huracán STO', 'Urus'],
            'Nissan' => ['GT-R', 'Z Proto', 'Skyline R34'],
        ];

        foreach ($data as $brandName => $models) {
            $brand = Brand::where('name', $brandName)->first();
            
            if ($brand) {
                foreach ($models as $modelName) {
                    VehicleModel::create([
                        'brand_id' => $brand->id,
                        'name' => $modelName,
                    ]);
                }
            }
        }
    }
}