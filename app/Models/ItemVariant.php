<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemVariant extends Model
{
    protected $fillable = [
        'item_id',
        'sku',
        'customer_code',
        'name',
        'selling_price',
        'cost_price',
        'stock_qty',
        'min_stock_qty',
        'is_active',
    ];

    protected $casts = [
        'selling_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'stock_qty' => 'integer',
        'min_stock_qty' => 'integer',
        'is_active' => 'boolean',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(ItemOptionValue::class, 'item_variant_option_values');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ItemVariantImage::class);
    }

    public function primaryImage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ItemVariantImage::class)->where('is_primary', true);
    }
}
