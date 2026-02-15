<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemOption extends Model
{
    protected $fillable = [
        'item_id',
        'name',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(ItemOptionValue::class, 'item_option_id');
    }
}
