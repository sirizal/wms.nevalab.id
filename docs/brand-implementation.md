# Brand Implementation Guide

This document describes how to add a `Brand` entity to the application using PostgreSQL without enums. It includes migration, model, seeder, and usage examples. The seeder inserts 10 real-world brands for the `Cleaning Products` category.

## Overview

- Table: `brands`
- Columns: `id`, `name`, `slug` (unique), `description`, `item_category_id` (FK), `created_at`, `updated_at`
- Relationship: `Brand` belongs to `ItemCategory` (parent category `cleaning-products`)
- Columns: `id`, `name`, `slug` (unique), `description`, `logo_url`, `item_category_id` (FK), `created_at`, `updated_at`
- Relationship: `Brand` belongs to `ItemCategory` (parent category `cleaning-products`)

## Migration

Create migration file: `database/migrations/2026_02_15_000003_create_brands_table.php`

Key points:

- Uses `foreignId('item_category_id')->constrained('item_categories')->onDelete('cascade')`.
- Adds indexes on `slug` and `item_category_id` for performance.

## Model

File: `app/Models/Brand.php`

- Fillable: `name`, `slug`, `description`, `item_category_id`.
- Fillable: `name`, `slug`, `description`, `logo_url`, `item_category_id`.
- Relationship: `category()` -> `belongsTo(ItemCategory::class)`.

## Seeder

File: `database/seeders/BrandSeeder.php`

- Ensures a `cleaning-products` `ItemCategory` exists (creates it if missing).
- Inserts 10 brands:
    - Clorox
    - Lysol
    - Mr. Clean
    - Ecolab
    - 3M
    - Diversey
    - Zep
    - OxiClean
    - Seventh Generation
    - Method

Run the seeder with:

```bash
php artisan db:seed --class=BrandSeeder
```

Or include it in `DatabaseSeeder` and run `php artisan db:seed`.

## Usage Examples

```php
// Get all brands for cleaning products
$category = ItemCategory::where('slug', 'cleaning-products')->first();
$brands = $category ? Brand::where('item_category_id', $category->id)->get() : collect();

// Find brand by slug
$brand = Brand::where('slug', 'clorox')->first();

// Create a brand
Brand::create([
    'name' => 'New Brand',
  'slug' => 'new-brand',
  'description' => 'Description here',
  'logo_url' => 'https://example.com/logos/new-brand.png',
  'item_category_id' => $category->id,
]);
```

## Notes

- Slugs are URL-friendly and unique; follow `lowercase-hyphen` convention.
- The migration uses `onDelete('cascade')` so removing a category will remove its brands.
- No PostgreSQL enums are used.
