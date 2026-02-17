<?php

namespace App\Filament\Resources\LocationTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LocationTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label(__('filament.resources.location_types.fields.code'))
                    ->required(),
                TextInput::make('name')
                    ->label(__('filament.resources.location_types.fields.name')),
                Toggle::make('is_physical')
                    ->label(__('filament.resources.location_types.fields.is_physical'))
                    ->default(true),
                Toggle::make('can_store_inventory')
                    ->label(__('filament.resources.location_types.fields.can_store_inventory'))
                    ->default(false),
            ]);
    }
}
