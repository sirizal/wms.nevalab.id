<?php

namespace App\Filament\Resources\Items\Resources\ItemVariants\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class ItemVariantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')
                    ->label(__('filament.resources.items.relations.item_variants.fields.sku'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_code')
                    ->label(__('filament.resources.items.relations.item_variants.fields.customer_code'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.items.relations.item_variants.fields.name'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('selling_price')
                    ->label(__('filament.resources.items.relations.item_variants.fields.selling_price'))
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock_qty')
                    ->label(__('filament.resources.items.relations.item_variants.fields.stock_qty'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.resources.items.relations.item_variants.fields.is_active'))
                    ->boolean(),
            ])
            ->filters([
                //
            ]);
    }
}
