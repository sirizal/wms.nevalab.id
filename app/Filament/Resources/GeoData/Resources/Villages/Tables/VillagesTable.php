<?php

namespace App\Filament\Resources\GeoData\Resources\Villages\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class VillagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.geo_data.villages.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('postal_code')
                    ->label(__('filament.resources.geo_data.villages.fields.postal_code'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ]);
    }
}
