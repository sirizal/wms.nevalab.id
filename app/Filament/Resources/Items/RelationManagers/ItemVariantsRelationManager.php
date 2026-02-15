<?php

namespace App\Filament\Resources\Items\RelationManagers;

use App\Filament\Resources\Items\Resources\ItemVariants\ItemVariantResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ItemVariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    protected static ?string $relatedResource = ItemVariantResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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

    public function table(Table $table): Table
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
            ->headerActions([
                Actions\CreateAction::make()
                    ->url(fn (): string => ItemVariantResource::getUrl('create', [
                        'item' => $this->getOwnerRecord(),
                    ])),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => ItemVariantResource::getUrl('edit', [
                        'item' => $this->getOwnerRecord(),
                        'record' => $record,
                    ])),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
