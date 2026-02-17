<?php

namespace App\Filament\Resources\Warehouses\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WarehousesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->label(__('filament.resources.warehouses.fields.company'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('code')
                    ->label(__('filament.resources.warehouses.fields.code'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('filament.resources.warehouses.fields.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('personInCharge.name')
                    ->label(__('filament.resources.warehouses.fields.person_in_charge'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone_no')
                    ->label(__('filament.resources.warehouses.fields.phone_no'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('country.name')
                    ->label(__('filament.resources.warehouses.fields.country'))
                    ->searchable()
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->label(__('filament.resources.warehouses.fields.is_active'))
                    ->boolean()
                    ->sortable(),
                IconColumn::make('is_rent')
                    ->label(__('filament.resources.warehouses.fields.is_rent'))
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
