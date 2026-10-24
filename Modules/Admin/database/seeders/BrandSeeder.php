<?php
namespace Modules\Admin\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Admin\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $featuredBrands = [
            'Porsche',
            'Ferrari',
            'Lamborghini',
            'McLaren',
            'Bugatti',
            'Aston Martin',
            'Rolls-Royce',
            'Bentley',
            'Koenigsegg',
            'Pagani',
            'Mercedes-Benz',
            'BMW',
            'Audi',
            'Toyota',
            'Tesla',
        ];

        $brands = [
            // Supercars and hypercars
            ['name' => 'Ferrari', 'website' => 'https://www.ferrari.com'],
            ['name' => 'Lamborghini', 'website' => 'https://www.lamborghini.com'],
            ['name' => 'McLaren', 'website' => 'https://www.mclaren.com'],
            ['name' => 'Bugatti', 'website' => 'https://www.bugatti.com'],
            ['name' => 'Koenigsegg', 'website' => 'https://www.koenigsegg.com'],
            ['name' => 'Pagani', 'website' => 'https://www.pagani.com'],
            ['name' => 'Rimac', 'website' => 'https://www.rimac-automobili.com'],
            ['name' => 'Lotus', 'website' => 'https://www.lotuscars.com'],
            ['name' => 'Maserati', 'website' => 'https://www.maserati.com'],
            ['name' => 'Porsche', 'website' => 'https://www.porsche.com'],
            ['name' => 'Aston Martin', 'website' => 'https://www.astonmartin.com'],
            ['name' => 'Alpine', 'website' => 'https://www.alpine-cars.co.uk'],

            // Luxury and premium
            ['name' => 'Rolls-Royce', 'website' => 'https://www.rolls-roycemotorcars.com'],
            ['name' => 'Bentley', 'website' => 'https://www.bentleymotors.com'],
            ['name' => 'Mercedes-Benz', 'website' => 'https://www.mercedes-benz.com'],
            ['name' => 'BMW', 'website' => 'https://www.bmw.com'],
            ['name' => 'Audi', 'website' => 'https://www.audi.com'],
            ['name' => 'Lexus', 'website' => 'https://www.lexus.com'],
            ['name' => 'Genesis', 'website' => 'https://www.genesis.com'],
            ['name' => 'Volvo', 'website' => 'https://www.volvocars.com'],
            ['name' => 'Polestar', 'website' => 'https://www.polestar.com'],
            ['name' => 'Jaguar', 'website' => 'https://www.jaguar.com'],
            ['name' => 'Land Rover', 'website' => 'https://www.landrover.com'],
            ['name' => 'Lincoln', 'website' => 'https://www.lincoln.com'],
            ['name' => 'Cadillac', 'website' => 'https://www.cadillac.com'],
            ['name' => 'Acura', 'website' => 'https://www.acura.com'],
            ['name' => 'Infiniti', 'website' => 'https://www.infiniti.com'],

            // Japanese manufacturers and JDM
            ['name' => 'Toyota', 'website' => 'https://www.toyota.com'],
            ['name' => 'Honda', 'website' => 'https://automobiles.honda.com'],
            ['name' => 'Nissan', 'website' => 'https://www.nissan-global.com'],
            ['name' => 'Mazda', 'website' => 'https://www.mazda.com'],
            ['name' => 'Subaru', 'website' => 'https://www.subaru.com'],
            ['name' => 'Mitsubishi', 'website' => 'https://www.mitsubishicars.com'],
            ['name' => 'Suzuki', 'website' => 'https://www.globalsuzuki.com'],
            ['name' => 'Isuzu', 'website' => 'https://www.isuzu.co.jp'],
            ['name' => 'Daihatsu', 'website' => 'https://www.daihatsu.com'],
            ['name' => 'Mitsuoka', 'website' => 'https://www.mitsuoka-motor.com'],

            // American manufacturers
            ['name' => 'Ford', 'website' => 'https://www.ford.com'],
            ['name' => 'Chevrolet', 'website' => 'https://www.chevrolet.com'],
            ['name' => 'GMC', 'website' => 'https://www.gmc.com'],
            ['name' => 'Buick', 'website' => 'https://www.buick.com'],
            ['name' => 'Dodge', 'website' => 'https://www.dodge.com'],
            ['name' => 'Chrysler', 'website' => 'https://www.chrysler.com'],
            ['name' => 'Jeep', 'website' => 'https://www.jeep.com'],
            ['name' => 'Ram', 'website' => 'https://www.ramtrucks.com'],
            ['name' => 'Rivian', 'website' => 'https://rivian.com'],
            ['name' => 'Lucid', 'website' => 'https://lucidmotors.com'],
            ['name' => 'Tesla', 'website' => 'https://www.tesla.com'],
            ['name' => 'Hennessey', 'website' => 'https://www.hennesseyspecialvehicles.com'],

            // European manufacturers
            ['name' => 'Volkswagen', 'website' => 'https://www.vw.com'],
            ['name' => 'Skoda', 'website' => 'https://www.skoda-auto.com'],
            ['name' => 'SEAT', 'website' => 'https://www.seat.com'],
            ['name' => 'CUPRA', 'website' => 'https://www.cupraofficial.com'],
            ['name' => 'Renault', 'website' => 'https://www.renaultgroup.com'],
            ['name' => 'Peugeot', 'website' => 'https://www.peugeot.com'],
            ['name' => 'Citroën', 'website' => 'https://www.citroen.com'],
            ['name' => 'DS Automobiles', 'website' => 'https://www.dsautomobiles.com'],
            ['name' => 'Fiat', 'website' => 'https://www.fiat.com'],
            ['name' => 'Alfa Romeo', 'website' => 'https://www.alfaromeo.com'],
            ['name' => 'Lancia', 'website' => 'https://www.lancia.com'],
            ['name' => 'Opel', 'website' => 'https://www.opel.com'],
            ['name' => 'Vauxhall', 'website' => 'https://www.vauxhall.co.uk'],
            ['name' => 'MINI', 'website' => 'https://www.mini.com'],
            ['name' => 'Smart', 'website' => 'https://www.smart.com'],
            ['name' => 'Dacia', 'website' => 'https://www.dacia.com'],

            // South Korean manufacturers
            ['name' => 'Hyundai', 'website' => 'https://www.hyundai.com'],
            ['name' => 'Kia', 'website' => 'https://www.kia.com'],
            ['name' => 'KG Mobility', 'website' => 'https://www.kg-mobility.com'],

            // Chinese manufacturers and EV brands
            ['name' => 'BYD', 'website' => 'https://www.byd.com'],
            ['name' => 'Geely', 'website' => 'https://www.geely.com'],
            ['name' => 'Zeekr', 'website' => 'https://www.zeekrglobal.com'],
            ['name' => 'NIO', 'website' => 'https://www.nio.com'],
            ['name' => 'XPeng', 'website' => 'https://www.xpeng.com'],
            ['name' => 'Li Auto', 'website' => 'https://www.lixiang.com'],
            ['name' => 'Leapmotor', 'website' => 'https://www.leapmotor.com'],
            ['name' => 'GWM', 'website' => 'https://www.gwm-global.com'],
            ['name' => 'Haval', 'website' => 'https://www.haval.com'],
            ['name' => 'Chery', 'website' => 'https://www.cheryinternational.com'],
            ['name' => 'MG', 'website' => 'https://www.mgmotor.com'],
            ['name' => 'Hongqi', 'website' => 'https://www.hongqi-auto.com'],
            ['name' => 'Changan', 'website' => 'https://www.globalchangan.com'],
            ['name' => 'GAC', 'website' => 'https://www.gacgroup.com'],
            ['name' => 'FAW', 'website' => 'https://www.faw.com'],
            ['name' => 'Dongfeng', 'website' => 'https://www.dfmc.com.cn'],
            ['name' => 'BAIC', 'website' => 'https://www.baicgroup.com.cn'],
            ['name' => 'JAC', 'website' => 'https://www.jac.com.cn'],
            ['name' => 'Omoda', 'website' => 'https://www.omodaauto.com'],
            ['name' => 'Jaecoo', 'website' => 'https://www.jaecoo.com'],

            // Indian manufacturers
            ['name' => 'Tata', 'website' => 'https://www.tatamotors.com'],
            ['name' => 'Mahindra', 'website' => 'https://www.mahindra.com'],
            ['name' => 'Maruti Suzuki', 'website' => 'https://www.marutisuzuki.com'],
            ['name' => 'Force Motors', 'website' => 'https://www.forcemotors.com'],

            // Commercial, off-road and specialist
            ['name' => 'Ineos', 'website' => 'https://ineosgrenadier.com'],
            ['name' => 'Morgan', 'website' => 'https://www.morgan-motor.com'],
            ['name' => 'Caterham', 'website' => 'https://caterhamcars.com'],
            ['name' => 'Ariel', 'website' => 'https://www.arielmotor.co.uk'],
            ['name' => 'BAC', 'website' => 'https://www.bac-mono.com'],
            ['name' => 'KTM', 'website' => 'https://www.ktm.com'],
            ['name' => 'Donkervoort', 'website' => 'https://www.donkervoort.com'],
            ['name' => 'TVR', 'website' => 'https://www.tvr.co.uk'],
            ['name' => 'Pininfarina', 'website' => 'https://www.automobili-pininfarina.com'],

            // Classic and historically significant marques
            ['name' => 'DeLorean', 'website' => 'https://www.delorean.com'],
            ['name' => 'Pontiac', 'website' => 'https://www.pontiac.com'],
            ['name' => 'Oldsmobile', 'website' => 'https://www.oldsmobile.com'],
            ['name' => 'Plymouth', 'website' => 'https://www.plymouth.com'],
            ['name' => 'Saturn', 'website' => 'https://www.saturn.com'],
            ['name' => 'Saab', 'website' => 'https://www.saab.com'],
            ['name' => 'Lada', 'website' => 'https://www.lada.ru'],
            ['name' => 'Moskvich', 'website' => 'https://moskvich-auto.ru'],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['name' => $brand['name']],
                [
                    'slug' => Str::slug($brand['name']),
                    'is_featured' => in_array(
                        $brand['name'],
                        $featuredBrands,
                        true,
                    ),
                    'website_url' => $brand['website'],
                    'logo' => 'logos/' . Str::slug($brand['name']) . '.svg',
                ],
            );
        }
    }
}
