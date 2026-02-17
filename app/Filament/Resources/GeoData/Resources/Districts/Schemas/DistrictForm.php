<?php

namespace App\Filament\Resources\GeoData\Resources\Districts\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('province_id'),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.geo_data.districts.fields.name'))
                    ->required(),
            ]);
    }
}
