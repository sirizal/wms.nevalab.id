<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'warehouse_id',
        'parent_id',
        'location_type_id',
        'code',
        'name',
        'level',
        'length',
        'width',
        'height',
        'max_weight',
        'is_active',
        'is_locked',
        'is_picking_area',
        'is_receiving_area',
        'is_dispatch_area',
        'temperature_zone',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_locked' => 'boolean',
        'is_picking_area' => 'boolean',
        'is_receiving_area' => 'boolean',
        'is_dispatch_area' => 'boolean',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'max_weight' => 'decimal:2',
    ];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    public function locationType(): BelongsTo
    {
        return $this->belongsTo(LocationType::class);
    }
}
