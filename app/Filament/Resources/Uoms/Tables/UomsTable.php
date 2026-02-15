<?php

namespace App\Filament\Resources\Uoms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UomsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.resources.uoms.fields.name'))
                    ->searchable(),
                TextColumn::make('code')
                    ->label(__('filament.resources.uoms.fields.code'))
                    ->searchable(),
                TextColumn::make('symbol')
                    ->label(__('filament.resources.uoms.fields.symbol'))
                    ->searchable(),
                TextColumn::make('uomType.name')
                    ->label(__('filament.resources.uoms.fields.uom_type'))
                    ->searchable(),
                TextColumn::make('conversion_factor')
                    ->label(__('filament.resources.uoms.fields.conversion_factor'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('baseUom.name')
                    ->label(__('filament.resources.uoms.fields.base_uom'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament.resources.uoms.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament.resources.uoms.fields.updated_at'))
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
