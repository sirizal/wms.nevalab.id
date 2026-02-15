<?php

namespace App\Filament\Resources\Items\Resources\ItemOptions\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class ItemOptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.items.relations.item_options.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('values_count')
                    ->label(__('filament.resources.items.relations.item_options.fields.values_count'))
                    ->counts('values'),
            ])
            ->filters([
                //
            ]);
    }
}
