<?php

namespace App\Filament\Resources\Items\RelationManagers;

use App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\ItemVariantImageResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ItemVariantImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $relatedResource = ItemVariantImageResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\FileUpload::make('image')
                    ->label(__('filament.resources.items.relations.item_variant_images.fields.image'))
                    ->image()
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

    public function table(Table $table): Table
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
            ->headerActions([
                Actions\CreateAction::make()
                    ->url(fn (): string => ItemVariantImageResource::getUrl('create', [
                        'item' => $this->getOwnerRecord()->item,
                        'item_variant' => $this->getOwnerRecord(),
                    ])),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => ItemVariantImageResource::getUrl('edit', [
                        'item' => $this->getOwnerRecord()->item,
                        'item_variant' => $this->getOwnerRecord(),
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
