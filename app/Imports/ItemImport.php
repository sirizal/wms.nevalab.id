<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Uom;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemImport implements ToCollection, WithHeadingRow
{
    public array $skippedRows = [];

    public function collection(Collection $collection): void
    {
        foreach ($collection as $index => $row) {
            $slug = Str::slug($row['name']);
            $existingItem = Item::where('slug', $slug)->first();

            if ($existingItem) {
                $this->skippedRows[] = [
                    'name' => $row['name'],
                    'slug' => $slug,
                    'customer_code' => $row['customer_code'] ?? null,
                    'description' => $row['description'] ?? null,
                    'main_image' => $row['main_image'] ?? null,
                    'item_category' => $row['item_category'] ?? null,
                    'brand' => $row['brand'] ?? null,
                    'uom' => $row['uom'] ?? null,
                    'is_active' => $row['is_active'] ?? true,
                    'remark' => 'Duplicate slug: '.$slug,
                ];

                continue;
            }

            $itemCategoryId = null;
            if (! empty($row['item_category'])) {
                $itemCategory = ItemCategory::where('slug', $row['item_category'])->first();
                $itemCategoryId = $itemCategory?->id;
            }

            $brandId = null;
            if (! empty($row['brand'])) {
                $brand = Brand::where('slug', $row['brand'])->first();
                $brandId = $brand?->id;
            }

            $uomId = null;
            if (! empty($row['uom'])) {
                $uom = Uom::where('code', $row['uom'])->first();
                $uomId = $uom?->id;
            }

            Item::create([
                'name' => $row['name'],
                'slug' => $slug,
                'customer_code' => $row['customer_code'] ?? null,
                'description' => $row['description'] ?? null,
                'main_image' => $row['main_image'] ?? null,
                'item_category_id' => $itemCategoryId,
                'brand_id' => $brandId,
                'uom_id' => $uomId,
                'is_active' => $row['is_active'] ?? true,
            ]);
        }
    }

    public function getSkippedRows(): array
    {
        return $this->skippedRows;
    }
}
