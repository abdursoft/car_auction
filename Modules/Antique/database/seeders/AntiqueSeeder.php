<?php

namespace Modules\Antique\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Antique\Models\Antique;

class AntiqueSeeder extends Seeder
{
    public function run(): void
    {
        $antiques = [
            [
                'title' => 'Victorian Mahogany Writing Desk',
                'slug' => 'victorian-mahogany-writing-desk',
                'description' => 'A beautifully preserved Victorian-era writing desk featuring carved mahogany details and traditional craftsmanship.',
                'maker' => 'Unknown Victorian Craftsman',
                'estimated_period' => 'Late 19th Century',
                'material' => 'Mahogany Wood',
                'dimensions' => '120 x 60 x 78 cm',
                'condition' => 'Good',
                'restoration_history' => 'Minor surface restoration; original structure retained.',
                'provenance' => 'Private estate collection',
                'authenticity_status' => 'unverified',
                'appraisal_value' => 1800.00,
            ],
            [
                'title' => 'Antique Persian Floral Rug',
                'slug' => 'antique-persian-floral-rug',
                'description' => 'A handwoven Persian rug with intricate floral motifs and traditional colors.',
                'maker' => 'Unknown Persian Weaver',
                'estimated_period' => 'Early 20th Century',
                'material' => 'Wool',
                'dimensions' => '250 x 160 cm',
                'condition' => 'Good',
                'restoration_history' => 'Small edge repairs.',
                'provenance' => 'Private collector',
                'authenticity_status' => 'unverified',
                'appraisal_value' => 950.00,
            ],
            [
                'title' => 'Vintage Gold Pocket Watch',
                'slug' => 'vintage-gold-pocket-watch',
                'description' => 'A classic mechanical pocket watch with an ornate case and traditional dial.',
                'maker' => 'Unknown Watchmaker',
                'estimated_period' => 'Early 20th Century',
                'material' => 'Gold-plated Metal',
                'dimensions' => 'Diameter 5 cm',
                'condition' => 'Fair',
                'restoration_history' => 'Mechanical servicing recommended.',
                'provenance' => 'Family heirloom; documentation unavailable.',
                'authenticity_status' => 'unverified',
                'appraisal_value' => 450.00,
            ],
            [
                'title' => 'Antique Blue and White Porcelain Vase',
                'slug' => 'antique-blue-white-porcelain-vase',
                'description' => 'A decorative porcelain vase with hand-painted blue floral patterns.',
                'maker' => 'Unknown Ceramic Workshop',
                'estimated_period' => 'Early 20th Century',
                'material' => 'Porcelain',
                'dimensions' => '35 x 18 cm',
                'condition' => 'Good',
                'restoration_history' => 'No known restoration.',
                'provenance' => 'Private decorative arts collection',
                'authenticity_status' => 'unverified',
                'appraisal_value' => 600.00,
            ],
            [
                'title' => 'Antique Landscape Oil Painting',
                'slug' => 'antique-landscape-oil-painting',
                'description' => 'A framed landscape painting in a traditional style, suitable for collectors of historical artwork.',
                'maker' => 'Artist Unknown',
                'estimated_period' => 'Late 19th to Early 20th Century',
                'material' => 'Oil on Canvas',
                'dimensions' => '70 x 50 cm',
                'condition' => 'Good',
                'restoration_history' => 'Frame shows age-related wear.',
                'provenance' => 'Previous ownership records unavailable.',
                'authenticity_status' => 'unverified',
                'appraisal_value' => 1200.00,
            ],
            [
                'title' => 'Historic Coin Collection',
                'slug' => 'historic-coin-collection',
                'description' => 'A small collection of historical coins offered as a single collectible lot.',
                'maker' => 'Various Mints',
                'estimated_period' => '19th to 20th Century',
                'material' => 'Mixed Metals',
                'dimensions' => 'Multiple sizes',
                'condition' => 'Used',
                'restoration_history' => 'No restoration reported.',
                'provenance' => 'Collector collection; origin records incomplete.',
                'authenticity_status' => 'unverified',
                'appraisal_value' => 300.00,
            ],
        ];

        foreach ($antiques as $data) {
            Antique::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
