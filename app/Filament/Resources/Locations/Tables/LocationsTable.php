<?php

namespace App\Filament\Resources\Locations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LocationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('warehouse.name')
                    ->label(__('filament.resources.locations.fields.warehouse'))
                    ->searchable(),
                TextColumn::make('parent.name')
                    ->label(__('filament.resources.locations.fields.parent'))
                    ->searchable(),
                TextColumn::make('locationType.name')
                    ->label(__('filament.resources.locations.fields.location_type'))
                    ->searchable(),
                TextColumn::make('code')
                    ->label(__('filament.resources.locations.fields.code'))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('filament.resources.locations.fields.name'))
                    ->searchable(),
                TextColumn::make('level')
                    ->label(__('filament.resources.locations.fields.level'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('length')
                    ->label(__('filament.resources.locations.fields.length'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('width')
                    ->label(__('filament.resources.locations.fields.width'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('height')
                    ->label(__('filament.resources.locations.fields.height'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('max_weight')
                    ->label(__('filament.resources.locations.fields.max_weight'))
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label(__('filament.resources.locations.fields.is_active'))
                    ->boolean(),
                IconColumn::make('is_locked')
                    ->label(__('filament.resources.locations.fields.is_locked'))
                    ->boolean(),
                IconColumn::make('is_picking_area')
                    ->label(__('filament.resources.locations.fields.is_picking_area'))
                    ->boolean(),
                IconColumn::make('is_receiving_area')
                    ->label(__('filament.resources.locations.fields.is_receiving_area'))
                    ->boolean(),
                IconColumn::make('is_dispatch_area')
                    ->label(__('filament.resources.locations.fields.is_dispatch_area'))
                    ->boolean(),
                TextColumn::make('temperature_zone')
                    ->label(__('filament.resources.locations.fields.temperature_zone'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament.resources.locations.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament.resources.locations.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
