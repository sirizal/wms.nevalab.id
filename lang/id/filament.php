<?php

return [
    'resources' => [
        'uoms' => [
            'uom' => [
                'model_label' => 'Satuan',
                'plural_model_label' => 'Satuan',
                'navigation_group' => 'Master Item',
            ],
            'fields' => [
                'name' => 'Nama',
                'code' => 'Kode',
                'symbol' => 'Simbol',
                'uom_type' => 'Tipe Satuan',
                'conversion_factor' => 'Faktor Konversi',
                'base_uom' => 'Satuan Dasar',
                'created_at' => 'Dibuat Pada',
                'updated_at' => 'Diperbarui Pada',
            ],
            'validation' => [
                'uom_cannot_be_own_base' => 'Satuan tidak dapat menjadi satuan dasar dirinya sendiri.',
                'circular_reference' => 'Referensi melingkar terdeteksi. Satuan yang dipilih sudah diturunkan dari satuan ini.',
            ],
        ],
        'uom_types' => [
            'fields' => [
                'name' => 'Nama',
            ],
        ],
        'item_categories' => [
            'uom' => [
                'model_label' => 'Kategori Item',
                'plural_model_label' => 'Kategori Items',
                'navigation_group' => 'Master Item',
            ],
            'fields' => [
                'id' => 'ID',
                'name' => 'Nama',
                'slug' => 'Slug',
                'description' => 'Deskripsi',
                'parent_category' => 'Kategori Induk',
                'created_at' => 'Dibuat Pada',
                'updated_at' => 'Diperbarui Pada',
            ],
            'validation' => [
                'category_cannot_be_own_parent' => 'Kategori tidak dapat menjadi kategori induk dirinya sendiri.',
                'circular_reference' => 'Referensi melingkar terdeteksi. Kategori yang dipilih sudah merupakan anak dari kategori ini.',
            ],
        ],
        'brands' => [
            'uom' => [
                'model_label' => 'Merek',
                'plural_model_label' => 'Merek',
                'navigation_group' => 'Master Item',
            ],
            'fields' => [
                'id' => 'ID',
                'name' => 'Nama',
                'slug' => 'Slug',
                'description' => 'Deskripsi',
                'item_category' => 'Kategori Item',
                'logo_url' => 'Logo',
                'created_at' => 'Dibuat Pada',
                'updated_at' => 'Diperbarui Pada',
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
                'name' => 'Nama',
                'slug' => 'Slug',
                'description' => 'Deskripsi',
                'item_category' => 'Kategori Item',
                'brand' => 'Merek',
                'uom' => 'Satuan',
                'is_active' => 'Aktif',
                'created_at' => 'Dibuat Pada',
                'updated_at' => 'Diperbarui Pada',
            ],
            'relations' => [
                'item_options' => [
                    'model_label' => 'Opsi',
                    'plural_model_label' => 'Opsi',
                    'fields' => [
                        'item' => 'Item',
                        'name' => 'Nama',
                        'values_count' => 'Jumlah Nilai',
                    ],
                ],
                'item_option_values' => [
                    'model_label' => 'Nilai Opsi',
                    'plural_model_label' => 'Nilai Opsi',
                    'fields' => [
                        'option' => 'Opsi',
                        'value' => 'Nilai',
                    ],
                ],
                'item_variants' => [
                    'model_label' => 'Varian',
                    'plural_model_label' => 'Varian',
                    'fields' => [
                        'item' => 'Item',
                        'sku' => 'SKU',
                        'customer_code' => 'Kode Pelanggan',
                        'name' => 'Nama',
                        'selling_price' => 'Harga Jual',
                        'cost_price' => 'Harga Pokok',
                        'stock_qty' => 'Jumlah Stok',
                        'min_stock_qty' => 'Min Stok',
                        'is_active' => 'Aktif',
                    ],
                ],
                'item_variant_images' => [
                    'model_label' => 'Gambar',
                    'plural_model_label' => 'Gambar',
                    'fields' => [
                        'image' => 'Gambar',
                        'sort_order' => 'Urutan',
                        'is_primary' => 'Utama',
                    ],
                ],
            ],
        ],
    ],
];
