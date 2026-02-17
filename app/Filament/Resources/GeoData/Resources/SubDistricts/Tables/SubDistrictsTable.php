<?php

namespace App\Filament\Resources\GeoData\Resources\SubDistricts\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class SubDistrictsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.geo_data.sub_districts.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('villages_count')
                    ->label(__('filament.resources.geo_data.sub_districts.fields.villages_count'))
                    ->counts('villages'),
            ])
            ->filters([
                //
            ]);
    }
}
