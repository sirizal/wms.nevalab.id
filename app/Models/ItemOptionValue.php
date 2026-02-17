<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ItemOptionValue extends Model
{
    protected $fillable = [
        'item_option_id',
        'value',
    ];

    public function option(): BelongsTo
    {
        return $this->belongsTo(ItemOption::class, 'item_option_id');
    }

    public function itemOption(): BelongsTo
    {
        return $this->belongsTo(ItemOption::class, 'item_option_id');
    }

    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(ItemVariant::class, 'item_variant_option_values');
    }
}
