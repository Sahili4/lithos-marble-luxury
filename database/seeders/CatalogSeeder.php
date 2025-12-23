<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogs = [
            [
                'name' => 'Carrara Statuario',
                'slug' => 'carrara-statuario',
                'origin' => 'Tuscany, Italy',
                'description' => 'The finest white marble with elegant grey veining, sourced from the historic Carrara quarries.',
                'image' => 'assets/images/carrara.png',
                'type' => 'Marble',
                'application' => 'Countertops, Walls',
                'is_featured' => true,
                'sort_order' => 1,
                'status' => true,
            ],
            [
                'name' => 'Nero Marquina',
                'slug' => 'nero-marquina',
                'origin' => 'Basque Country, Spain',
                'description' => 'Luxurious black marble with distinctive white veining, perfect for dramatic interiors.',
                'image' => 'assets/images/marquina.png',
                'type' => 'Marble',
                'application' => 'Flooring, Feature Walls',
                'is_featured' => true,
                'sort_order' => 2,
                'status' => true,
            ],
            [
                'name' => 'Calacatta Oro',
                'slug' => 'calacatta-oro',
                'origin' => 'Apuan Alps, Italy',
                'description' => 'Premium white marble with bold golden veins, the epitome of luxury and sophistication.',
                'image' => 'assets/images/calacatta.png',
                'type' => 'Marble',
                'application' => 'Statement Walls, Bathrooms',
                'is_featured' => true,
                'sort_order' => 3,
                'status' => true,
            ],
            [
                'name' => 'Azul Macaubas',
                'slug' => 'azul-macaubas',
                'origin' => 'Bahia, Brazil',
                'description' => 'Stunning blue quartzite with unique patterns, bringing oceanic elegance to any space.',
                'image' => 'assets/images/azul.png',
                'type' => 'Quartzite',
                'application' => 'Countertops, Accent Walls',
                'is_featured' => false,
                'sort_order' => 4,
                'status' => true,
            ],
        ];

        foreach ($catalogs as $catalog) {
            Catalog::create($catalog);
        }
    }
}
