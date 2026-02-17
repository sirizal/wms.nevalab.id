<?php

namespace App\Filament\Resources\GeoData\Resources\Countries\Pages;

use App\Filament\Resources\GeoData\Resources\Countries\CountryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;
}
