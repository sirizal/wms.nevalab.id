<?php

namespace App\Filament\Resources\GeoData\Resources\Provinces\RelationManagers;

use App\Filament\Resources\GeoData\Resources\Districts\DistrictResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class DistrictsRelationManager extends RelationManager
{
    protected static string $relationship = 'districts';

    protected static ?string $relatedResource = DistrictResource::class;

    public function table(Table $table): Table
    {
        $province = $this->getOwnerRecord();
        $country = $province->country;

        return $table
            ->recordTitleAttribute('name')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.geo_data.districts.fields.name'))
                    ->searchable()
                    ->sortable(),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->url(fn (): string => DistrictResource::getUrl('create', [
                        'country' => $country,
                        'province' => $province,
                    ])),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => DistrictResource::getUrl('edit', [
                        'country' => $country,
                        'province' => $province,
                        'record' => $record,
                    ])),
                Actions\DeleteAction::make(),
            ]);
    }
}
