<?php

namespace App\Filament\Resources\Items\RelationManagers;

use App\Filament\Resources\Items\Resources\ItemOptions\ItemOptionResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ItemOptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'options';

    protected static ?string $relatedResource = ItemOptionResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.items.relations.item_options.fields.name'))
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
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
            ->headerActions([
                Actions\CreateAction::make()
                    ->url(fn (): string => ItemOptionResource::getUrl('create', [
                        'item' => $this->getOwnerRecord(),
                    ])),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => ItemOptionResource::getUrl('edit', [
                        'item' => $this->getOwnerRecord(),
                        'record' => $record,
                    ])),
                Actions\DeleteAction::make(),
            ])
            ->modifyQueryUsing(fn ($query) => $query->withCount('values'));
    }
}
