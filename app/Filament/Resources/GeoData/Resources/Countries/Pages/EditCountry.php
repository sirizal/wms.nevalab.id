<?php

namespace App\Filament\Resources\GeoData\Resources\Countries\Pages;

use App\Filament\Resources\GeoData\Resources\Countries\CountryResource;
use Filament\Resources\Pages\EditRecord;

class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;
}
