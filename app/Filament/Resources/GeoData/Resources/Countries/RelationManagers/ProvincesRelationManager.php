<?php

namespace App\Filament\Resources\GeoData\Resources\Countries\RelationManagers;

use App\Filament\Resources\GeoData\Resources\Provinces\ProvinceResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ProvincesRelationManager extends RelationManager
{
    protected static string $relationship = 'provinces';

    protected static ?string $relatedResource = ProvinceResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.geo_data.provinces.fields.name'))
                    ->searchable()
                    ->sortable(),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->url(fn (): string => ProvinceResource::getUrl('create', [
                        'country' => $this->getOwnerRecord(),
                    ])),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => ProvinceResource::getUrl('edit', [
                        'country' => $this->getOwnerRecord(),
                        'record' => $record,
                    ])),
                Actions\DeleteAction::make(),
            ]);
    }
}
