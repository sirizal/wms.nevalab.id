<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('warehouse_id')
                    ->label(__('filament.resources.locations.fields.warehouse'))
                    ->relationship('warehouse', 'name')
                    ->required(),
                Select::make('parent_id')
                    ->label(__('filament.resources.locations.fields.parent'))
                    ->relationship('parent', 'name'),
                Select::make('location_type_id')
                    ->label(__('filament.resources.locations.fields.location_type'))
                    ->relationship('locationType', 'name')
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament.resources.locations.fields.code'))
                    ->required(),
                TextInput::make('name')
                    ->label(__('filament.resources.locations.fields.name')),
                TextInput::make('level')
                    ->label(__('filament.resources.locations.fields.level'))
                    ->numeric()
                    ->default(0),
                TextInput::make('length')
                    ->label(__('filament.resources.locations.fields.length'))
                    ->numeric(),
                TextInput::make('width')
                    ->label(__('filament.resources.locations.fields.width'))
                    ->numeric(),
                TextInput::make('height')
                    ->label(__('filament.resources.locations.fields.height'))
                    ->numeric(),
                TextInput::make('max_weight')
                    ->label(__('filament.resources.locations.fields.max_weight'))
                    ->numeric(),
                Toggle::make('is_active')
                    ->label(__('filament.resources.locations.fields.is_active'))
                    ->default(true),
                Toggle::make('is_locked')
                    ->label(__('filament.resources.locations.fields.is_locked'))
                    ->default(false),
                Toggle::make('is_picking_area')
                    ->label(__('filament.resources.locations.fields.is_picking_area'))
                    ->default(false),
                Toggle::make('is_receiving_area')
                    ->label(__('filament.resources.locations.fields.is_receiving_area'))
                    ->default(false),
                Toggle::make('is_dispatch_area')
                    ->label(__('filament.resources.locations.fields.is_dispatch_area'))
                    ->default(false),
                TextInput::make('temperature_zone')
                    ->label(__('filament.resources.locations.fields.temperature_zone')),
            ]);
    }
}
