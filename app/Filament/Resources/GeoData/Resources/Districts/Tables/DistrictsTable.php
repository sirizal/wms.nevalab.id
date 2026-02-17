<?php

namespace App\Filament\Resources\GeoData\Resources\Districts\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class DistrictsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.geo_data.districts.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sub_districts_count')
                    ->label(__('filament.resources.geo_data.districts.fields.sub_districts_count'))
                    ->counts('subDistricts'),
            ])
            ->filters([
                //
            ]);
    }
}
