<?php

namespace App\Filament\Resources\GeoData\Resources\Villages\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class VillageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('sub_district_id'),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.geo_data.villages.fields.name'))
                    ->required(),
                Forms\Components\TextInput::make('postal_code')
                    ->label(__('filament.resources.geo_data.villages.fields.postal_code'))
                    ->maxLength(20),
            ]);
    }
}
