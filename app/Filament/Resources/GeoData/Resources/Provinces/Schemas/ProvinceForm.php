<?php

namespace App\Filament\Resources\GeoData\Resources\Provinces\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class ProvinceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('country_id'),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.geo_data.provinces.fields.name'))
                    ->required(),
            ]);
    }
}
