<?php

namespace App\Filament\Resources\GeoData\Resources\Countries\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('code')
                    ->label(__('filament.resources.geo_data.countries.fields.code'))
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.geo_data.countries.fields.name'))
                    ->required(),
            ]);
    }
}
