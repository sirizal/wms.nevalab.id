# Item Category Implementation Guide

This guide provides a complete implementation of the hierarchical Item Category system for a Laravel 12 warehouse management system using PostgreSQL. The system uses a parent-child relational structure for maximum flexibility and extensibility.

## Table of Contents

1. [Architecture Overview](#architecture-overview)
2. [Database Migration](#database-migration)
3. [Model](#model)
4. [Seeder](#seeder)
5. [Usage Examples](#usage-examples)

---

## Architecture Overview

The Item Category system is designed to organize and categorize inventory items in a hierarchical structure. Parent categories group related subcategories, providing a flexible taxonomy suitable for a cleaning service ecommerce business.

### Database Schema

```
item_categories
├── id (PK, bigint)
├── name (string)
├── slug (string, unique)
├── description (text, nullable)
├── parent_category_id (bigint, nullable, FK)
└── timestamps
```

### Design Principles

- **Hierarchical Structure**: Self-referencing foreign key enables unlimited depth of subcategories.
- **URL-Friendly Slug**: Each category has a unique slug for programmatic and URL-friendly reference.
- **Flexible Names**: Category names are not unique, allowing multiple subcategories with the same name under different parents.
- **Cascade Delete**: Deleting a parent category cascades to all children.
- **No Enums**: PostgreSQL enums avoided for flexibility—new categories don't require migrations.
- **Audit Trail**: Timestamps track creation and updates.
- **Optimized Queries**: Database indexes on frequently queried columns for performance.

---

## Database Migration

**File**: `database/migrations/2026_02_15_000000_create_item_categories_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_category_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_category_id')
                  ->references('id')
                  ->on('item_categories')
                  ->onDelete('cascade');

            // Indexes
            $table->index('parent_category_id');
            $table->index('slug');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_categories');
    }
};
```

### Column Descriptions

| Column               | Type      | Constraints                 | Purpose                                                                    |
| -------------------- | --------- | --------------------------- | -------------------------------------------------------------------------- |
| `id`                 | bigint    | Primary Key, Auto-increment | Unique identifier for each category                                        |
| `name`               | string    | Not Null                    | Human-readable category name (e.g., "Disinfectants")                       |
| `slug`               | string    | Unique, Not Null            | URL-friendly identifier (e.g., "disinfectants") for programming and routes |
| `description`        | text      | Nullable                    | Detailed description of what items belong to this category                 |
| `parent_category_id` | bigint    | Nullable, FK                | Foreign key to parent category (null for root categories)                  |
| `created_at`         | timestamp | Not Null                    | Records when the category was created                                      |
| `updated_at`         | timestamp | Not Null                    | Records when the category was last updated                                 |

### Database Indexes

| Index       | Columns              | Purpose                                      |
| ----------- | -------------------- | -------------------------------------------- |
| Primary Key | `id`                 | Fast lookup by category ID                   |
| Unique      | `slug`               | Prevent duplicate slugs and fast slug lookup |
| Regular     | `parent_category_id` | Fast filtering of child categories           |
| Regular     | `slug`               | UI searches and route generation             |
| Regular     | `created_at`         | Timeline queries and admin panels            |

---

## Model

**File**: `app/Models/ItemCategory.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_category_id',
    ];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class, 'parent_category_id');
    }

    public function childCategories(): HasMany
    {
        return $this->hasMany(ItemCategory::class, 'parent_category_id');
    }
}
```

### Model Features

- **Fillable Properties**: All columns are mass-assignable for convenient CRUD operations.
- **Parent Relationship**: Access the parent category via `parentCategory()` method (returns null for root categories).
- **Child Relationship**: Access all direct children via `childCategories()` method.
- **Self-Referencing**: The model references itself for hierarchical structures.
- **Timestamps**: Automatically managed by Laravel for audit trails.

### Common Methods

```php
// Get parent category
$parent = $category->parentCategory;

// Get all direct children
$children = $category->childCategories;

// Get all children (eager loaded)
$children = $category->childCategories()->get();

// Check if root category (no parent)
if ($category->parent_category_id === null) {
    // This is a root category
}

// Find by slug
$category = ItemCategory::where('slug', 'disinfectants')->first();
```

---

## Seeder

**File**: `database/seeders/ItemCategorySeeder.php`

The seeder initializes the system with a comprehensive hierarchical category structure representing a typical ecommerce cleaning service business. Each parent category has at least 10 specialized subcategories.

### Category Hierarchy

```
├── Cleaning Products
│   ├── Disinfectants
│   ├── Detergents
│   ├── Degreasers
│   ├── Bleach & Sanitizers
│   ├── Glass Cleaners
│   ├── Floor Care Products
│   ├── Carpet Cleaners
│   ├── Surface Protectants
│   ├── Air Fresheners
│   └── Specialized Cleaning Solutions
├── Parts & Equipment
│   ├── Mops & Handles
│   ├── Brushes & Brooms
│   ├── Vacuum Cleaners
│   ├── Floor Polishers
│   ├── Pressure Washers
│   ├── Buckets & Carts
│   ├── Squeegees & Scrapers
│   ├── Microfiber Cloths
│   ├── Equipment Accessories
│   └── Wastebaskets & Containers
├── Food & Supplies
│   ├── Coffee & Tea
│   ├── Juices & Soft Drinks
│   ├── Water & Hydration
│   ├── Snack Foods
│   ├── Protein & Bars
│   ├── Meal Provisions
│   ├── Condiments & Sauces
│   ├── Paper & Napkins
│   ├── Cutlery & Utensils
│   └── Containers & Packaging
└── Uniforms & PPE
    ├── Latex Gloves
    ├── Nitrile Gloves
    ├── Work Gloves
    ├── Aprons & Protective Wear
    ├── Uniforms & Vests
    ├── Safety Glasses
    ├── Face Masks & Respirators
    ├── Footwear
    ├── Head Protection
    └── First Aid & Medical
```

### Summary

- **4 Root Categories**
- **40+ Subcategories** (10+ per parent)
- **Real-world ecommerce items** for cleaning services
- **URL-friendly slugs** for all categories

### Creating a Root Category

```php
use App\Models\ItemCategory;

$category = ItemCategory::create([
    'name' => 'Safety Equipment',
    'slug' => 'safety-equipment',
    'description' => 'Safety equipment and protective gear',
    'parent_category_id' => null,
]);
```

### Creating a Subcategory

```php
// Create under an existing parent
$parent = ItemCategory::where('slug', 'uniforms-ppe')->first();

$subcategory = ItemCategory::create([
    'name' => 'Safety Glasses',
    'slug' => 'safety-glasses',
    'description' => 'Safety glasses and protective eyewear',
    'parent_category_id' => $parent->id,
]);
```

### Retrieving Categories

```php
// Get all root categories (no parent)
$rootCategories = ItemCategory::where('parent_category_id', null)->get();

// Get all subcategories of a parent
$parent = ItemCategory::find(1);
$children = $parent->childCategories()->get();

// Get a category with its parent
$category = ItemCategory::find(1);
$parentCategory = $category->parentCategory;

// Find by slug (URL-friendly)
$category = ItemCategory::where('slug', 'disinfectants')->first();

// Find by slug using route model binding
$category = ItemCategory::where('slug', request('category'))->first();

// Get all descendants with eager loading
$category = ItemCategory::with('childCategories')->find(1);
```

### Querying Hierarchies

```php
// Get only subcategories (has parent)
$subcategories = ItemCategory::whereNotNull('parent_category_id')
    ->orderBy('name')
    ->get();

// Get categories under a specific parent
$cleaningProducts = ItemCategory::where('slug', 'cleaning-products')->first();
$subItems = $cleaningProducts->childCategories;

// Count children
$childCount = $category->childCategories()->count();
```

### Updating a Category

```php
$category = ItemCategory::find(1);
$category->update([
    'description' => 'Updated description',
]);

// Move a category to a different parent
$category->update([
    'parent_category_id' => 5,
]);
```

### Deleting a Category

```php
$category = ItemCategory::find(1);
$category->delete();  // Cascades to all children

// Only delete if it has no children
if ($category->childCategories()->count() === 0) {
    $category->delete();
}
```

---

## Running the Migration and Seeder

```bash
# Run the migration
php artisan migrate

# Run the seeder
php artisan db:seed --class=ItemCategorySeeder

# Or run all seeders
php artisan db:seed
```

---

## Future Enhancements

1. **Add Status Field**: Add `is_active` boolean to enable/disable categories without deletion.
2. **Add Sort Order**: Add `sort_order` integer to control category display sequence.
3. **Add Meta Information**: Add fields like `icon`, `color`, or `image_url` for UI presentation.
4. **Add Items Relationship**: Create `Item` model with `belongs_to` relationship to categories.
5. **Add Audit Logging**: Track user actions (create, update, delete) on category changes.
6. **Add Breadcrumb Helper**: Create a method to generate breadcrumb paths for category hierarchies.
7. **Recursive Descendants**: Add method to get all descendants at any depth level.
8. **Soft Deletes**: Implement soft deletes to preserve category history and relationships.

---

## Notes

- The `slug` field should follow a consistent naming convention (lowercase with hyphens recommended).
- Root categories have `parent_category_id = null`.
- Deleting a parent category cascades to all children.
- The design avoids PostgreSQL enums for flexibility—new categories can be added through the application UI without database migrations.
- The seeder provides real-world ecommerce cleaning service categories organized hierarchically with 40+ subcategories.
- Slugs are unique and URL-friendly, making them ideal for routing and SEO.
- Database indexes optimize queries for common operations like filtering by parent and searching by slug.
