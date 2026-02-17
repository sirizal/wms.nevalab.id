<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'customer_code',
        'description',
        'main_image',
        'item_category_id',
        'brand_id',
        'uom_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::created(function (Item $item) {
            $item->createDefaultVariant();
        });
    }

    public function createDefaultVariant(): ItemVariant
    {
        return ItemVariant::create([
            'item_id' => $this->id,
            'sku' => $this->slug,
            'name' => $this->name,
            'selling_price' => 0,
            'cost_price' => 0,
            'stock_qty' => 0,
            'min_stock_qty' => 0,
            'is_active' => true,
        ]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function uom(): BelongsTo
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(ItemOption::class);
    }

    public function itemOptions(): HasMany
    {
        return $this->hasMany(ItemOption::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ItemVariant::class);
    }
}
