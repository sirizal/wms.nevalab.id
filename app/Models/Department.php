<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'superior_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function superior(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'superior_id');
    }

    public function subordinates(): HasMany
    {
        return $this->hasMany(Department::class, 'superior_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
