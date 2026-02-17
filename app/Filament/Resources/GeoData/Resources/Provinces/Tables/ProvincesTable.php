<?php

namespace App\Filament\Resources\GeoData\Resources\Provinces\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class ProvincesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.geo_data.provinces.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('districts_count')
                    ->label(__('filament.resources.geo_data.provinces.fields.districts_count'))
                    ->counts('districts'),
            ])
            ->filters([
                //
            ]);
    }
}
