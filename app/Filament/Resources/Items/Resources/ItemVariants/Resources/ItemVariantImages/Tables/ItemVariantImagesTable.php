<?php

namespace App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class ItemVariantImagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('filament.resources.items.relations.item_variant_images.fields.image')),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('filament.resources.items.relations.item_variant_images.fields.sort_order'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_primary')
                    ->label(__('filament.resources.items.relations.item_variant_images.fields.is_primary'))
                    ->boolean(),
            ])
            ->filters([
                //
            ]);
    }
}
