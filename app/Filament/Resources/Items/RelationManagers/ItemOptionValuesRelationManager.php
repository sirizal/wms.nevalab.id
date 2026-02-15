<?php

namespace App\Filament\Resources\Items\RelationManagers;

use App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\ItemOptionValueResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ItemOptionValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'values';

    protected static ?string $relatedResource = ItemOptionValueResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('value')
                    ->label(__('filament.resources.items.relations.item_option_values.fields.value'))
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('value')
                    ->label(__('filament.resources.items.relations.item_option_values.fields.value'))
                    ->searchable()
                    ->sortable(),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->url(fn (): string => ItemOptionValueResource::getUrl('create', [
                        'item' => $this->getOwnerRecord()->item,
                        'item_option' => $this->getOwnerRecord(),
                    ])),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => ItemOptionValueResource::getUrl('edit', [
                        'item' => $this->getOwnerRecord()->item,
                        'item_option' => $this->getOwnerRecord(),
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
