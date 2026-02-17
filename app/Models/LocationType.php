<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LocationType extends Model
{
    protected $fillable = [
        'code',
        'name',
        'is_physical',
        'can_store_inventory',
    ];

    protected $casts = [
        'is_physical' => 'boolean',
        'can_store_inventory' => 'boolean',
    ];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
