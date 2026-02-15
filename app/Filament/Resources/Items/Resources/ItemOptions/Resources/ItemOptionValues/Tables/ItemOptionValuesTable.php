<?php

namespace App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class ItemOptionValuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('value')
                    ->label(__('filament.resources.items.relations.item_option_values.fields.value'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ]);
    }
}
