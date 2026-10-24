<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Models\Brand;
use Modules\Car\Models\VehicleModel;

class VehicleModelSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Porsche' => [
                '911 Carrera',
                '911 Turbo S',
                '911 GT3 RS',
                '718 Cayman GT4 RS',
                '718 Boxster',
                'Taycan',
                'Panamera',
                'Cayenne',
                'Macan',
            ],

            'BMW' => [
                'M2',
                'M3',
                'M4',
                'M5',
                'M8',
                'X3 M',
                'X5 M',
                'X6 M',
                'i4',
                'i5',
                'i7',
                'i8',
            ],

            'Mercedes-Benz' => [
                'C-Class',
                'E-Class',
                'S-Class',
                'AMG GT',
                'AMG C 63',
                'G-Class',
                'GLC',
                'GLE',
                'EQS',
            ],

            'Audi' => [
                'A4',
                'A6',
                'A8',
                'RS3',
                'RS5',
                'RS6 Avant',
                'R8',
                'Q5',
                'Q7',
                'e-tron GT',
            ],

            'Ferrari' => [
                '296 GTB',
                '488 Pista',
                'F8 Tributo',
                'SF90 Stradale',
                'Roma',
                '812 Competizione',
                'Purosangue',
                'LaFerrari',
            ],

            'Lamborghini' => [
                'Aventador SVJ',
                'Huracán STO',
                'Huracán EVO',
                'Revuelto',
                'Urus',
                'Gallardo',
                'Murciélago',
            ],

            'McLaren' => [
                '570S',
                '600LT',
                '720S',
                '750S',
                '765LT',
                'Artura',
                'P1',
                'Senna',
            ],

            'Nissan' => [
                'GT-R',
                '370Z',
                '350Z',
                'Z',
                'Skyline GT-R R32',
                'Skyline GT-R R34',
                'Silvia S15',
                'Patrol',
            ],

            'Toyota' => [
                'Supra',
                'GR86',
                'GR Yaris',
                'Land Cruiser',
                'Land Cruiser Prado',
                'Corolla',
                'Camry',
                'RAV4',
                'Prius',
            ],

            'Honda' => [
                'Civic Type R',
                'NSX',
                'Accord',
                'Civic',
                'CR-V',
                'Integra Type R',
                'S2000',
            ],

            'Ford' => [
                'Mustang GT',
                'Mustang Shelby GT500',
                'GT',
                'Focus RS',
                'Bronco',
                'F-150 Raptor',
                'Ranger Raptor',
            ],

            'Chevrolet' => [
                'Corvette C8',
                'Corvette Z06',
                'Camaro ZL1',
                'Camaro SS',
                'Chevelle SS',
                'Impala',
                'Tahoe',
                'Silverado',
            ],

            'Tesla' => [
                'Model S',
                'Model 3',
                'Model X',
                'Model Y',
                'Cybertruck',
            ],

            'Rolls-Royce' => [
                'Phantom',
                'Ghost',
                'Wraith',
                'Dawn',
                'Cullinan',
                'Spectre',
            ],

            'Bentley' => [
                'Continental GT',
                'Flying Spur',
                'Bentayga',
                'Mulsanne',
            ],
        ];

        foreach ($data as $brandName => $models) {
            $brand = Brand::where('name', $brandName)->first();

            if (! $brand) {
                $this->command?->warn(
                    "Brand not found: {$brandName}. Skipping its models."
                );

                continue;
            }

            foreach ($models as $modelName) {
                VehicleModel::updateOrCreate(
                    [
                        'brand_id' => $brand->id,
                        'name' => $modelName,
                    ],
                    [
                        'name' => $modelName,
                        'slug' => \Illuminate\Support\Str::slug($modelName),
                    ]
                );
            }
        }
    }
}
