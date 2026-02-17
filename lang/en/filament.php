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
                'customer_code' => 'Customer Code',
                'description' => 'Description',
                'main_image' => 'Main Image',
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
        'geo_data' => [
            'navigation_group' => 'Geo Data',
            'countries' => [
                'model_label' => 'Country',
                'plural_model_label' => 'Countries',
                'fields' => [
                    'code' => 'Code',
                    'name' => 'Name',
                ],
            ],
            'provinces' => [
                'model_label' => 'Province',
                'plural_model_label' => 'Provinces',
                'fields' => [
                    'name' => 'Name',
                    'districts_count' => 'Districts Count',
                ],
            ],
            'districts' => [
                'model_label' => 'District',
                'plural_model_label' => 'Districts',
                'fields' => [
                    'name' => 'Name',
                    'sub_districts_count' => 'Sub Districts Count',
                ],
            ],
            'sub_districts' => [
                'model_label' => 'Sub District',
                'plural_model_label' => 'Sub Districts',
                'fields' => [
                    'name' => 'Name',
                    'villages_count' => 'Villages Count',
                ],
            ],
            'villages' => [
                'model_label' => 'Village',
                'plural_model_label' => 'Villages',
                'fields' => [
                    'name' => 'Name',
                    'postal_code' => 'Postal Code',
                ],
            ],
        ],
        'companies' => [
            'navigation_group' => 'Company Data',
            'model_label' => 'Company',
            'plural_model_label' => 'Companies',
            'fields' => [
                'name' => 'Name',
                'contact' => 'Contact',
                'email_address' => 'Email Address',
                'phone' => 'Phone',
                'website' => 'Website',
                'address' => 'Address',
                'country' => 'Country',
                'province' => 'Province',
                'district' => 'District',
                'sub_district' => 'Sub District',
                'village' => 'Village',
                'postal_code' => 'Postal Code',
                'tax_no' => 'Tax Number',
            ],
            'departments' => [
                'model_label' => 'Department',
                'plural_model_label' => 'Departments',
                'fields' => [
                    'name' => 'Name',
                    'superior' => 'Superior',
                    'employees_count' => 'Employees Count',
                ],
            ],
            'employees' => [
                'model_label' => 'Employee',
                'plural_model_label' => 'Employees',
                'fields' => [
                    'code' => 'Code',
                    'name' => 'Name',
                    'id_no' => 'ID Number',
                    'phone_no' => 'Phone Number',
                    'email_address' => 'Email Address',
                    'user' => 'User',
                    'is_active' => 'Active',
                ],
            ],
        ],
        'warehouses' => [
            'navigation_group' => 'Warehouse Data',
            'model_label' => 'Warehouse',
            'plural_model_label' => 'Warehouses',
            'fields' => [
                'company' => 'Company',
                'code' => 'Code',
                'name' => 'Name',
                'person_in_charge' => 'Person In Charge',
                'phone_no' => 'Phone Number',
                'address' => 'Address',
                'country' => 'Country',
                'province' => 'Province',
                'district' => 'District',
                'sub_district' => 'Sub District',
                'village' => 'Village',
                'postal_code' => 'Postal Code',
                'latitude' => 'Latitude',
                'longitude' => 'Longitude',
                'is_active' => 'Active',
                'is_rent' => 'Is Rent',
                'rent_period' => 'Rent Period',
                'rent_cost' => 'Rent Cost',
                'rent_expired' => 'Rent Expired',
                'square_meter' => 'Square Meter',
            ],
            'sections' => [
                'basic_info' => 'Basic Information',
                'address' => 'Address',
                'location' => 'Location',
                'rent_info' => 'Rent Information',
                'other' => 'Other',
            ],
        ],
    ],
];
