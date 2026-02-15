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
