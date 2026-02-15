<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemOption;
use App\Models\ItemOptionValue;
use App\Models\ItemVariant;
use App\Models\ItemVariantImage;
use App\Models\Uom;
use Illuminate\Database\Seeder;

class ItemRunningShoesSeeder extends Seeder
{
    public function run(): void
    {
        $brand = Brand::firstOrCreate(
            ['slug' => 'nike'],
            [
                'name' => 'Nike',
                'description' => 'Nike Running Shoes - Premium athletic footwear',
                'item_category_id' => 42,
                'logo_url' => 'brands/nike-logo.png',
            ]
        );

        $uom = Uom::firstOrCreate(
            ['code' => 'PCS'],
            [
                'name' => 'Pieces',
                'symbol' => 'pcs',
            ]
        );

        $item = Item::create([
            'name' => 'Nike Air Zoom Pegasus 40',
            'slug' => 'nike-air-zoom-pegasus-40',
            'description' => 'The Nike Air Zoom Pegasus 40 delivers exceptional cushioning and responsiveness for runners of all levels. Featuring a breathable mesh upper and Zoom Air cushioning, this shoe is perfect for daily training and long runs.',
            'item_category_id' => 42,
            'brand_id' => $brand->id,
            'uom_id' => $uom->id,
            'is_active' => true,
        ]);

        $sizeOption = ItemOption::create([
            'item_id' => $item->id,
            'name' => 'Size',
        ]);

        $colorOption = ItemOption::create([
            'item_id' => $item->id,
            'name' => 'Color',
        ]);

        $shoelaceOption = ItemOption::create([
            'item_id' => $item->id,
            'name' => 'Shoelace',
        ]);

        $sizeValues = [
            ItemOptionValue::create(['item_option_id' => $sizeOption->id, 'value' => 'US 7']),
            ItemOptionValue::create(['item_option_id' => $sizeOption->id, 'value' => 'US 8']),
            ItemOptionValue::create(['item_option_id' => $sizeOption->id, 'value' => 'US 9']),
            ItemOptionValue::create(['item_option_id' => $sizeOption->id, 'value' => 'US 10']),
            ItemOptionValue::create(['item_option_id' => $sizeOption->id, 'value' => 'US 11']),
        ];

        $colorValues = [
            ItemOptionValue::create(['item_option_id' => $colorOption->id, 'value' => 'Black/White']),
            ItemOptionValue::create(['item_option_id' => $colorOption->id, 'value' => 'Pure White']),
            ItemOptionValue::create(['item_option_id' => $colorOption->id, 'value' => 'Royal Blue']),
            ItemOptionValue::create(['item_option_id' => $colorOption->id, 'value' => 'Sunset Orange']),
        ];

        $shoelaceValues = [
            ItemOptionValue::create(['item_option_id' => $shoelaceOption->id, 'value' => 'With Laces']),
            ItemOptionValue::create(['item_option_id' => $shoelaceOption->id, 'value' => 'Slip-on']),
        ];

        $basePrice = 150.00;
        $colorMultipliers = [
            'Black/White' => 1.0,
            'Pure White' => 1.0,
            'Royal Blue' => 1.05,
            'Sunset Orange' => 1.10,
        ];

        $variantData = [];

        foreach ($sizeValues as $size) {
            foreach ($colorValues as $color) {
                foreach ($shoelaceValues as $shoelace) {
                    $colorMultiplier = $colorMultipliers[$color->value] ?? 1.0;
                    $sellingPrice = $basePrice * $colorMultiplier;

                    $variant = ItemVariant::create([
                        'item_id' => $item->id,
                        'sku' => 'NIKE-PEG40-'.strtoupper(str_replace(' ', '-', $size->value)).'-'.strtoupper(str_replace(['/', ' '], '-', $color->value)).'-'.strtoupper(str_replace('-', '-', $shoelace->value)),
                        'customer_code' => 'CUST-'.rand(10000, 99999),
                        'name' => 'Nike Air Zoom Pegasus 40 - '.$size->value.' - '.$color->value.' - '.$shoelace->value,
                        'selling_price' => $sellingPrice,
                        'cost_price' => $sellingPrice * 0.6,
                        'stock_qty' => rand(5, 50),
                        'min_stock_qty' => 10,
                        'is_active' => true,
                    ]);

                    $variant->optionValues()->attach([
                        $size->id,
                        $color->id,
                        $shoelace->id,
                    ]);

                    $variantData[] = $variant;
                }
            }
        }

        $colorImages = [
            'Black/White' => ['black-white-1.jpg', 'black-white-2.jpg', 'black-white-3.jpg'],
            'Pure White' => ['pure-white-1.jpg', 'pure-white-2.jpg', 'pure-white-3.jpg'],
            'Royal Blue' => ['royal-blue-1.jpg', 'royal-blue-2.jpg', 'royal-blue-3.jpg'],
            'Sunset Orange' => ['sunset-orange-1.jpg', 'sunset-orange-2.jpg', 'sunset-orange-3.jpg'],
        ];

        foreach ($variantData as $index => $variant) {
            $colorValue = $variant->optionValues()
                ->where('item_option_id', $colorOption->id)
                ->first();

            if ($colorValue && isset($colorImages[$colorValue->value])) {
                $images = $colorImages[$colorValue->value];

                foreach ($images as $imgIndex => $image) {
                    ItemVariantImage::create([
                        'item_variant_id' => $variant->id,
                        'image_url' => 'items/variants/'.$image,
                        'sort_order' => $imgIndex,
                        'is_primary' => $imgIndex === 0,
                    ]);
                }
            }
        }

        $this->command->info('Running Shoes Item seeded successfully!');
        $this->command->info('Created Item: '.$item->name);
        $this->command->info('Created '.$sizeOption->values()->count().' Size options');
        $this->command->info('Created '.$colorOption->values()->count().' Color options');
        $this->command->info('Created '.$shoelaceOption->values()->count().' Shoelace options');
        $this->command->info('Created '.$variantData[0]->optionValues()->count().' total variants');
    }
}
