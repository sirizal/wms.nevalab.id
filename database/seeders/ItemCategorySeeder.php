<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Parent: Cleaning Products
        $cleaningProducts = ItemCategory::create([
            'name' => 'Cleaning Products',
            'slug' => 'cleaning-products',
            'description' => 'Cleaning agents and chemical products for sanitization.',
            'parent_category_id' => null,
        ]);

        ItemCategory::create([
            'name' => 'Disinfectants',
            'slug' => 'disinfectants',
            'description' => 'Disinfectant sprays, liquids, and wipes for bacterial and viral elimination.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        ItemCategory::create([
            'name' => 'Detergents',
            'slug' => 'detergents',
            'description' => 'Laundry detergents, floor cleaners, and general-purpose cleaners.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        ItemCategory::create([
            'name' => 'Degreasers',
            'slug' => 'degreasers',
            'description' => 'Heavy-duty degreasers for kitchen and industrial cleaning.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        ItemCategory::create([
            'name' => 'Bleach & Sanitizers',
            'slug' => 'bleach-sanitizers',
            'description' => 'Bleach and sanitizing solutions for high-strength disinfection.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        ItemCategory::create([
            'name' => 'Glass Cleaners',
            'slug' => 'glass-cleaners',
            'description' => 'Glass and window cleaning solutions for streak-free results.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        ItemCategory::create([
            'name' => 'Floor Care Products',
            'slug' => 'floor-care-products',
            'description' => 'Floor waxes, polishes, and maintenance products.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        ItemCategory::create([
            'name' => 'Carpet Cleaners',
            'slug' => 'carpet-cleaners',
            'description' => 'Carpet shampoos and specialized carpet cleaning solutions.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        ItemCategory::create([
            'name' => 'Surface Protectants',
            'slug' => 'surface-protectants',
            'description' => 'Protective coatings and sealers for various surfaces.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        ItemCategory::create([
            'name' => 'Air Fresheners',
            'slug' => 'air-fresheners',
            'description' => 'Odor eliminators and air freshening products.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        ItemCategory::create([
            'name' => 'Specialized Cleaning Solutions',
            'slug' => 'specialized-cleaning-solutions',
            'description' => 'Specialized cleaners for marble, stainless steel, and specific materials.',
            'parent_category_id' => $cleaningProducts->id,
        ]);

        // Parent: Parts & Equipment
        $partsEquipment = ItemCategory::create([
            'name' => 'Parts & Equipment',
            'slug' => 'parts-equipment',
            'description' => 'Replacement parts and cleaning equipment.',
            'parent_category_id' => null,
        ]);

        ItemCategory::create([
            'name' => 'Mops & Handles',
            'slug' => 'mops-handles',
            'description' => 'Mop heads, handles, and replacement mop systems.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        ItemCategory::create([
            'name' => 'Brushes & Brooms',
            'slug' => 'brushes-brooms',
            'description' => 'Brushes, brooms, and sweeping equipment.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        ItemCategory::create([
            'name' => 'Vacuum Cleaners',
            'slug' => 'vacuum-cleaners',
            'description' => 'Vacuum cleaners and vacuum systems for carpets and hard floors.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        ItemCategory::create([
            'name' => 'Floor Polishers',
            'slug' => 'floor-polishers',
            'description' => 'Electric floor polishers and buffers for surface finishing.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        ItemCategory::create([
            'name' => 'Pressure Washers',
            'slug' => 'pressure-washers',
            'description' => 'Pressure washing equipment for deep cleaning.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        ItemCategory::create([
            'name' => 'Buckets & Carts',
            'slug' => 'buckets-carts',
            'description' => 'Cleaning buckets, mop carts, and supply trolleys.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        ItemCategory::create([
            'name' => 'Squeegees & Scrapers',
            'slug' => 'squeegees-scrapers',
            'description' => 'Squeegees, scrapers, and cleaning tools for windows and surfaces.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        ItemCategory::create([
            'name' => 'Microfiber Cloths',
            'slug' => 'microfiber-cloths',
            'description' => 'Microfiber cloths, towels, and premium cleaning fabrics.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        ItemCategory::create([
            'name' => 'Equipment Accessories',
            'slug' => 'equipment-accessories',
            'description' => 'Replacement parts and accessories for cleaning equipment.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        ItemCategory::create([
            'name' => 'Wastebaskets & Containers',
            'slug' => 'wastebaskets-containers',
            'description' => 'Trash bins, containers, and waste collection systems.',
            'parent_category_id' => $partsEquipment->id,
        ]);

        // Parent: Food & Supplies
        $foodSupplies = ItemCategory::create([
            'name' => 'Food & Supplies',
            'slug' => 'food-supplies',
            'description' => 'Food items and supplies for staff and operations.',
            'parent_category_id' => null,
        ]);

        ItemCategory::create([
            'name' => 'Coffee & Tea',
            'slug' => 'coffee-tea',
            'description' => 'Coffee, tea, and hot beverage supplies.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        ItemCategory::create([
            'name' => 'Juices & Soft Drinks',
            'slug' => 'juices-soft-drinks',
            'description' => 'Juices, sodas, and non-alcoholic beverages.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        ItemCategory::create([
            'name' => 'Water & Hydration',
            'slug' => 'water-hydration',
            'description' => 'Bottled water, energy drinks, and hydration products.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        ItemCategory::create([
            'name' => 'Snack Foods',
            'slug' => 'snack-foods',
            'description' => 'Chips, crackers, nuts, and quick snack items.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        ItemCategory::create([
            'name' => 'Protein & Bars',
            'slug' => 'protein-bars',
            'description' => 'Protein bars, energy bars, and nutrition supplements.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        ItemCategory::create([
            'name' => 'Meal Provisions',
            'slug' => 'meal-provisions',
            'description' => 'Ready-to-eat meals and meal provision supplies.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        ItemCategory::create([
            'name' => 'Condiments & Sauces',
            'slug' => 'condiments-sauces',
            'description' => 'Salt, pepper, sauces, and seasoning supplies.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        ItemCategory::create([
            'name' => 'Paper & Napkins',
            'slug' => 'paper-napkins',
            'description' => 'Paper plates, napkins, and disposable dining items.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        ItemCategory::create([
            'name' => 'Cutlery & Utensils',
            'slug' => 'cutlery-utensils',
            'description' => 'Disposable cutlery, forks, spoons, and eating utensils.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        ItemCategory::create([
            'name' => 'Containers & Packaging',
            'slug' => 'containers-packaging',
            'description' => 'Food containers, packaging materials, and storage supplies.',
            'parent_category_id' => $foodSupplies->id,
        ]);

        // Parent: Uniforms & PPE
        $uniformsPPE = ItemCategory::create([
            'name' => 'Uniforms & PPE',
            'slug' => 'uniforms-ppe',
            'description' => 'Uniforms and personal protective equipment for staff.',
            'parent_category_id' => null,
        ]);

        ItemCategory::create([
            'name' => 'Latex Gloves',
            'slug' => 'latex-gloves',
            'description' => 'Latex protective gloves for cleaning and protection.',
            'parent_category_id' => $uniformsPPE->id,
        ]);

        ItemCategory::create([
            'name' => 'Nitrile Gloves',
            'slug' => 'nitrile-gloves',
            'description' => 'Nitrile gloves for allergy-free protection.',
            'parent_category_id' => $uniformsPPE->id,
        ]);

        ItemCategory::create([
            'name' => 'Work Gloves',
            'slug' => 'work-gloves',
            'description' => 'Durable work gloves for heavy-duty tasks.',
            'parent_category_id' => $uniformsPPE->id,
        ]);

        ItemCategory::create([
            'name' => 'Aprons & Protective Wear',
            'slug' => 'aprons-protective-wear',
            'description' => 'Protective aprons and protective clothing.',
            'parent_category_id' => $uniformsPPE->id,
        ]);

        ItemCategory::create([
            'name' => 'Uniforms & Vests',
            'slug' => 'uniforms-vests',
            'description' => 'Branded uniforms, vests, and branded identity wear.',
            'parent_category_id' => $uniformsPPE->id,
        ]);

        ItemCategory::create([
            'name' => 'Safety Glasses',
            'slug' => 'safety-glasses',
            'description' => 'Safety goggles and protective eyewear.',
            'parent_category_id' => $uniformsPPE->id,
        ]);

        ItemCategory::create([
            'name' => 'Face Masks & Respirators',
            'slug' => 'face-masks-respirators',
            'description' => 'Face masks and respiratory protection equipment.',
            'parent_category_id' => $uniformsPPE->id,
        ]);

        ItemCategory::create([
            'name' => 'Footwear',
            'slug' => 'footwear',
            'description' => 'Safety shoes and protective footwear.',
            'parent_category_id' => $uniformsPPE->id,
        ]);

        ItemCategory::create([
            'name' => 'Head Protection',
            'slug' => 'head-protection',
            'description' => 'Hard hats, helmets, and head protection gear.',
            'parent_category_id' => $uniformsPPE->id,
        ]);

        ItemCategory::create([
            'name' => 'First Aid & Medical',
            'slug' => 'first-aid-medical',
            'description' => 'First aid kits, medical supplies, and emergency equipment.',
            'parent_category_id' => $uniformsPPE->id,
        ]);
    }
}
