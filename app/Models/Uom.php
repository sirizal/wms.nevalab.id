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
