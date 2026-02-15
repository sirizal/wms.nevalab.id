<?php

namespace App\Filament\Resources\Items\Resources\ItemVariants\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class ItemVariantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('item_id'),
                Forms\Components\TextInput::make('sku')
                    ->label(__('filament.resources.items.relations.item_variants.fields.sku'))
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('customer_code')
                    ->label(__('filament.resources.items.relations.item_variants.fields.customer_code')),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.items.relations.item_variants.fields.name')),
                Forms\Components\TextInput::make('selling_price')
                    ->label(__('filament.resources.items.relations.item_variants.fields.selling_price'))
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('cost_price')
                    ->label(__('filament.resources.items.relations.item_variants.fields.cost_price'))
                    ->numeric(),
                Forms\Components\TextInput::make('stock_qty')
                    ->label(__('filament.resources.items.relations.item_variants.fields.stock_qty'))
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('min_stock_qty')
                    ->label(__('filament.resources.items.relations.item_variants.fields.min_stock_qty'))
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('filament.resources.items.relations.item_variants.fields.is_active'))
                    ->default(true),
            ]);
    }
}
