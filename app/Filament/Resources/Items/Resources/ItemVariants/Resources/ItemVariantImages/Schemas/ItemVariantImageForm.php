<?php

namespace App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class ItemVariantImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('item_variant_id'),
                Forms\Components\FileUpload::make('image')
                    ->label(__('filament.resources.items.relations.item_variant_images.fields.image'))
                    ->image()
                    ->disk('public')
                    ->directory('item-variants')
                    ->visibility('public')
                    ->maxSize(1024)
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->label(__('filament.resources.items.relations.item_variant_images.fields.sort_order'))
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_primary')
                    ->label(__('filament.resources.items.relations.item_variant_images.fields.is_primary'))
                    ->default(false),
            ]);
    }
}
