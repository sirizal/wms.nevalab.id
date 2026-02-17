<?php

namespace App\Filament\Resources\LocationTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LocationTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__('filament.resources.location_types.fields.code'))
                    ->searchable(),
                TextColumn::make('name')
                    ->label(__('filament.resources.location_types.fields.name'))
                    ->searchable(),
                IconColumn::make('is_physical')
                    ->label(__('filament.resources.location_types.fields.is_physical'))
                    ->boolean(),
                IconColumn::make('can_store_inventory')
                    ->label(__('filament.resources.location_types.fields.can_store_inventory'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(__('filament.resources.location_types.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament.resources.location_types.fields.updated_at'))
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
