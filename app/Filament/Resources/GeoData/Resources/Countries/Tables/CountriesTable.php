<?php

namespace App\Filament\Resources\GeoData\Resources\Countries\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class CountriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label(__('filament.resources.geo_data.countries.fields.code'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.geo_data.countries.fields.name'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ]);
    }
}
