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
