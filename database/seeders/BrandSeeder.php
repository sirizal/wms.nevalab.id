<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\ItemCategory;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have the Cleaning Products category
        $category = ItemCategory::firstWhere('slug', 'cleaning-products');
        if (! $category) {
            $category = ItemCategory::create([
                'name' => 'Cleaning Products',
                'slug' => 'cleaning-products',
                'description' => 'Cleaning agents and chemical products for sanitization.',
                'parent_category_id' => null,
            ]);
        }

        $brands = [
            ['name' => 'Clorox', 'slug' => 'clorox', 'description' => 'Bleach and disinfectant products.', 'logo_url' => 'https://example.com/logos/clorox.png'],
            ['name' => 'Lysol', 'slug' => 'lysol', 'description' => 'Disinfectant sprays and cleaning solutions.', 'logo_url' => 'https://example.com/logos/lysol.png'],
            ['name' => 'Mr. Clean', 'slug' => 'mr-clean', 'description' => 'All-purpose cleaners and surface care.', 'logo_url' => 'https://example.com/logos/mr-clean.png'],
            ['name' => 'Ecolab', 'slug' => 'ecolab', 'description' => 'Professional cleaning and sanitation solutions.', 'logo_url' => 'https://example.com/logos/ecolab.png'],
            ['name' => '3M', 'slug' => '3m', 'description' => 'Cleaning accessories, tapes, and industrial products.', 'logo_url' => 'https://example.com/logos/3m.png'],
            ['name' => 'Diversey', 'slug' => 'diversey', 'description' => 'Commercial cleaning and hygiene products.', 'logo_url' => 'https://example.com/logos/diversey.png'],
            ['name' => 'Zep', 'slug' => 'zep', 'description' => 'Industrial-strength cleaners and degreasers.', 'logo_url' => 'https://example.com/logos/zep.png'],
            ['name' => 'OxiClean', 'slug' => 'oxiclean', 'description' => 'Oxygen-based stain removers and cleaners.', 'logo_url' => 'https://example.com/logos/oxiclean.png'],
            ['name' => 'Seventh Generation', 'slug' => 'seventh-generation', 'description' => 'Plant-based, eco-friendly cleaning products.', 'logo_url' => 'https://example.com/logos/seventh-generation.png'],
            ['name' => 'Method', 'slug' => 'method', 'description' => 'Design-forward household cleaners and sanitizers.', 'logo_url' => 'https://example.com/logos/method.png'],
        ];

        foreach ($brands as $b) {
            Brand::updateOrCreate([
                'slug' => $b['slug'],
            ], [
                'name' => $b['name'],
                'description' => $b['description'],
                'logo_url' => $b['logo_url'] ?? null,
                'item_category_id' => $category->id,
            ]);
        }
    }
}
