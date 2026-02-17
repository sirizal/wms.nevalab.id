<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warehouse extends Model
{
    protected $fillable = [
        'company_id',
        'code',
        'name',
        'person_in_charge_id',
        'phone_no',
        'address',
        'country_id',
        'province_id',
        'district_id',
        'sub_district_id',
        'village_id',
        'postal_code',
        'latitude',
        'longitude',
        'is_active',
        'is_rent',
        'rent_period',
        'rent_cost',
        'rent_expired',
        'square_meter',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_rent' => 'boolean',
        'rent_expired' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function personInCharge(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'person_in_charge_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function subDistrict(): BelongsTo
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district_id');
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }
}
