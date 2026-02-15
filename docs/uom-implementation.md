# Unit Of Measurement (UOM) Implementation Guide

This guide provides a complete implementation of the Unit Of Measurement (UOM) system for a Laravel 12 application using PostgreSQL. The system uses relationship tables instead of enum columns for maximum flexibility.

## Table of Contents

1. [Architecture Overview](#architecture-overview)
2. [Database Migrations](#database-migrations)
3. [Models](#models)
4. [Seeder](#seeder)
5. [Usage Examples](#usage-examples)

---

## Architecture Overview

The UOM system consists of two main tables:

- **`uom_types`**: Stores measurement types (Length, Weight, Volume, Quantity)
- **`uoms`**: Stores individual units with conversion factors and relationships to types

### Database Schema

```
uom_types
├── id (PK)
├── name (string)
└── timestamps

uoms
├── id (PK)
├── name (string)
├── code (string, unique)
├── symbol (string)
├── uom_type_id (FK)
├── conversion_factor (double)
├── base_uom_id (FK, nullable, self-referencing)
└── timestamps
```

---

## Database Migrations

### Migration 1: Create `uom_types` Table

**File**: `database/migrations/xxxx_xx_xx_xxxxxx_create_uom_types_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uom_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uom_types');
    }
};
```

### Migration 2: Create `uoms` Table

**File**: `database/migrations/xxxx_xx_xx_xxxxxx_create_uoms_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uoms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('symbol');
            $table->foreignId('uom_type_id')->constrained('uom_types')->onDelete('cascade');
            $table->doublePrecision('conversion_factor')->default(1);
            $table->unsignedBigInteger('base_uom_id')->nullable();
            $table->timestamps();

            $table->foreign('base_uom_id')
                  ->references('id')
                  ->on('uoms')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uoms');
    }
};
```

---

## Models

### UomType Model

**File**: `app/Models/UomType.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UomType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function uoms(): HasMany
    {
        return $this->hasMany(Uom::class);
    }
}
```

### Uom Model

**File**: `app/Models/Uom.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Uom extends Model
{
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'uom_type_id',
        'conversion_factor',
        'base_uom_id',
    ];

    protected $casts = [
        'conversion_factor' => 'float',
    ];

    public function uomType(): BelongsTo
    {
        return $this->belongsTo(UomType::class);
    }

    public function baseUom(): BelongsTo
    {
        return $this->belongsTo(Uom::class, 'base_uom_id');
    }

    public function derivedUoms(): HasMany
    {
        return $this->hasMany(Uom::class, 'base_uom_id');
    }
}
```

---

## Seeder

### UomSeeder with Real Data

**File**: `database/seeders/UomSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\Uom;
use App\Models\UomType;
use Illuminate\Database\Seeder;

class UomSeeder extends Seeder
{
    public function run(): void
    {
        // Create UOM Types
        $lengthType = UomType::create([
            'name' => 'Length',
        ]);

        $weightType = UomType::create([
            'name' => 'Weight',
        ]);

        $volumeType = UomType::create([
            'name' => 'Volume',
        ]);

        $quantityType = UomType::create([
            'name' => 'Quantity',
        ]);

        // ============================================
        // Length UOMs
        // ============================================
        $meter = Uom::create([
            'name' => 'Meter',
            'code' => 'M',
            'symbol' => 'm',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Centimeter',
            'code' => 'CM',
            'symbol' => 'cm',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 0.01,
            'base_uom_id' => $meter->id,
        ]);

        Uom::create([
            'name' => 'Millimeter',
            'code' => 'MM',
            'symbol' => 'mm',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 0.001,
            'base_uom_id' => $meter->id,
        ]);

        Uom::create([
            'name' => 'Kilometer',
            'code' => 'KM',
            'symbol' => 'km',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 1000,
            'base_uom_id' => $meter->id,
        ]);

        Uom::create([
            'name' => 'Inch',
            'code' => 'IN',
            'symbol' => 'in',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 0.0254,
            'base_uom_id' => $meter->id,
        ]);

        Uom::create([
            'name' => 'Foot',
            'code' => 'FT',
            'symbol' => 'ft',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 0.3048,
            'base_uom_id' => $meter->id,
        ]);

        // ============================================
        // Weight UOMs
        // ============================================
        $kilogram = Uom::create([
            'name' => 'Kilogram',
            'code' => 'KG',
            'symbol' => 'kg',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Gram',
            'code' => 'G',
            'symbol' => 'g',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 0.001,
            'base_uom_id' => $kilogram->id,
        ]);

        Uom::create([
            'name' => 'Milligram',
            'code' => 'MG',
            'symbol' => 'mg',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 0.000001,
            'base_uom_id' => $kilogram->id,
        ]);

        Uom::create([
            'name' => 'Ton',
            'code' => 'T',
            'symbol' => 't',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 1000,
            'base_uom_id' => $kilogram->id,
        ]);

        Uom::create([
            'name' => 'Pound',
            'code' => 'LBS',
            'symbol' => 'lbs',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 0.453592,
            'base_uom_id' => $kilogram->id,
        ]);

        Uom::create([
            'name' => 'Ounce',
            'code' => 'OZ',
            'symbol' => 'oz',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 0.0283495,
            'base_uom_id' => $kilogram->id,
        ]);

        // ============================================
        // Volume UOMs
        // ============================================
        $liter = Uom::create([
            'name' => 'Liter',
            'code' => 'L',
            'symbol' => 'L',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Milliliter',
            'code' => 'ML',
            'symbol' => 'mL',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 0.001,
            'base_uom_id' => $liter->id,
        ]);

        Uom::create([
            'name' => 'Cubic Meter',
            'code' => 'M3',
            'symbol' => 'm³',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 1000,
            'base_uom_id' => $liter->id,
        ]);

        Uom::create([
            'name' => 'Gallon (US)',
            'code' => 'GAL_US',
            'symbol' => 'gal',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 3.78541,
            'base_uom_id' => $liter->id,
        ]);

        Uom::create([
            'name' => 'Fluid Ounce (US)',
            'code' => 'FL_OZ_US',
            'symbol' => 'fl oz',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 0.0295735,
            'base_uom_id' => $liter->id,
        ]);

        // ============================================
        // Quantity UOMs
        // ============================================
        $piece = Uom::create([
            'name' => 'Piece',
            'code' => 'PCS',
            'symbol' => 'pcs',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Dozen',
            'code' => 'DOZ',
            'symbol' => 'doz',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 12,
            'base_uom_id' => $piece->id,
        ]);

        Uom::create([
            'name' => 'Gross',
            'code' => 'GRO',
            'symbol' => 'gro',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 144,
            'base_uom_id' => $piece->id,
        ]);

        Uom::create([
            'name' => 'Box',
            'code' => 'BOX',
            'symbol' => 'box',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Pack',
            'code' => 'PACK',
            'symbol' => 'pack',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 1,
        ]);
    }
}
```

---

## Usage Examples

### Get All Units of a Type

```php
$lengthType = UomType::where('name', 'Length')->first();
$lengthUnits = $lengthType->uoms;
```

### Get a Specific UOM

```php
$meter = Uom::where('code', 'M')->first();
```

### Convert Value to Base Unit

```php
$uom = Uom::where('code', 'cm')->first();
$valueInMeters = 100 * $uom->conversion_factor; // 1 meter
```

### Get Derived Units (Conversions)

```php
$meter = Uom::where('code', 'M')->first();
$derivedUnits = $meter->derivedUoms; // CM, MM, KM, IN, FT
```

### Query by Type and Filter

```php
$weightUnits = Uom::whereHas('uomType', function ($query) {
    $query->where('name', 'Weight');
})->get();
```

---

## Installation Instructions

### Step 1: Create the Files

Use the code provided above to create or update:

- Migrations in `database/migrations/`
- Models in `app/Models/`
- Seeder in `database/seeders/`

### Step 2: Run Migrations

```bash
php artisan migrate
```

### Step 3: Seed the Database

```bash
php artisan db:seed --class=UomSeeder
```

### Step 4: Verify

Check the database:

```bash
SELECT * FROM uom_types;
SELECT * FROM uoms;
```

---

## Notes for PostgreSQL

- Uses `doublePrecision` for the `conversion_factor` column to handle decimal values in PostgreSQL
- Foreign key constraints use `onDelete('cascade')` and `onDelete('set null')` as appropriate
- All string columns are standard and compatible with PostgreSQL

---

## Performance Tips

- Index the `code` columns for faster lookups
- Use eager loading with `with('uomType')` when fetching UOMs to avoid N+1 queries
- Cache frequently accessed UOM types to improve performance

```php
$uoms = Uom::with('uomType', 'baseUom')->get();
```
