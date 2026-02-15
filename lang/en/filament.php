<?php

return [
    'resources' => [
        'uoms' => [
            'uom' => [
                'model_label' => 'UOM',
                'plural_model_label' => 'UOMs',
                'navigation_group' => 'Master Item',
            ],
            'fields' => [
                'name' => 'Name',
                'code' => 'Code',
                'symbol' => 'Symbol',
                'uom_type' => 'UOM Type',
                'conversion_factor' => 'Conversion Factor',
                'base_uom' => 'Base UOM',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
            'validation' => [
                'uom_cannot_be_own_base' => 'A UOM cannot be its own base UOM.',
                'circular_reference' => 'Circular reference detected. The selected UOM is already derived from this UOM.',
            ],
        ],
        'uom_types' => [
            'fields' => [
                'name' => 'Name',
            ],
        ],
        'item_categories' => [
            'uom' => [
                'model_label' => 'Item Category',
                'plural_model_label' => 'Item Categories',
                'navigation_group' => 'Master Item',
            ],
            'fields' => [
                'id' => 'ID',
                'name' => 'Name',
                'slug' => 'Slug',
                'description' => 'Description',
                'parent_category' => 'Parent Category',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
            'validation' => [
                'category_cannot_be_own_parent' => 'A category cannot be its own parent.',
                'circular_reference' => 'Circular reference detected. The selected category is already a child of this category.',
            ],
        ],
        'brands' => [
            'uom' => [
                'model_label' => 'Brand',
                'plural_model_label' => 'Brands',
                'navigation_group' => 'Master Item',
            ],
            'fields' => [
                'id' => 'ID',
                'name' => 'Name',
                'slug' => 'Slug',
                'description' => 'Description',
                'item_category' => 'Item Category',
                'logo_url' => 'Logo',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
        ],
        'items' => [
            'uom' => [
                'model_label' => 'Item',
                'plural_model_label' => 'Items',
                'navigation_group' => 'Master Item',
            ],
            'fields' => [
                'id' => 'ID',
                'name' => 'Name',
                'slug' => 'Slug',
                'description' => 'Description',
                'item_category' => 'Item Category',
                'brand' => 'Brand',
                'uom' => 'UOM',
                'is_active' => 'Active',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
            ],
            'relations' => [
                'item_options' => [
                    'model_label' => 'Option',
                    'plural_model_label' => 'Options',
                    'fields' => [
                        'item' => 'Item',
                        'name' => 'Name',
                        'values_count' => 'Values Count',
                    ],
                ],
                'item_option_values' => [
                    'model_label' => 'Option Value',
                    'plural_model_label' => 'Option Values',
                    'fields' => [
                        'option' => 'Option',
                        'value' => 'Value',
                    ],
                ],
                'item_variants' => [
                    'model_label' => 'Variant',
                    'plural_model_label' => 'Variants',
                    'fields' => [
                        'item' => 'Item',
                        'sku' => 'SKU',
                        'customer_code' => 'Customer Code',
                        'name' => 'Name',
                        'selling_price' => 'Selling Price',
                        'cost_price' => 'Cost Price',
                        'stock_qty' => 'Stock Qty',
                        'min_stock_qty' => 'Min Stock Qty',
                        'is_active' => 'Active',
                    ],
                ],
                'item_variant_images' => [
                    'model_label' => 'Image',
                    'plural_model_label' => 'Images',
                    'fields' => [
                        'image' => 'Image',
                        'sort_order' => 'Sort Order',
                        'is_primary' => 'Primary',
                    ],
                ],
            ],
        ],
    ],
];
