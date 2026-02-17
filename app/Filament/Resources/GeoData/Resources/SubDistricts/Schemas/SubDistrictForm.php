<?php

namespace App\Filament\Resources\GeoData\Resources\SubDistricts\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class SubDistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('district_id'),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.geo_data.sub_districts.fields.name'))
                    ->required(),
            ]);
    }
}
