<?php

namespace App\Filament\Resources\GeoData\Resources\SubDistricts\RelationManagers;

use App\Filament\Resources\GeoData\Resources\Villages\VillageResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class VillagesRelationManager extends RelationManager
{
    protected static string $relationship = 'villages';

    protected static ?string $relatedResource = VillageResource::class;

    public function table(Table $table): Table
    {
        $subDistrict = $this->getOwnerRecord();
        $district = $subDistrict->district;
        $province = $district->province;
        $country = $province->country;

        return $table
            ->recordTitleAttribute('name')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.geo_data.villages.fields.name'))
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('postal_code')
                    ->label(__('filament.resources.geo_data.villages.fields.postal_code'))
                    ->searchable()
                    ->sortable(),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->url(fn (): string => VillageResource::getUrl('create', [
                        'country' => $country,
                        'province' => $province,
                        'district' => $district,
                        'sub_district' => $subDistrict,
                    ])),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => VillageResource::getUrl('edit', [
                        'country' => $country,
                        'province' => $province,
                        'district' => $district,
                        'sub_district' => $subDistrict,
                        'record' => $record,
                    ])),
                Actions\DeleteAction::make(),
            ]);
    }
}
