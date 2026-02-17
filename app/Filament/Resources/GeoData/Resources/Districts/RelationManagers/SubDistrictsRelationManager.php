<?php

namespace App\Filament\Resources\GeoData\Resources\Districts\RelationManagers;

use App\Filament\Resources\GeoData\Resources\SubDistricts\SubDistrictResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class SubDistrictsRelationManager extends RelationManager
{
    protected static string $relationship = 'subDistricts';

    protected static ?string $relatedResource = SubDistrictResource::class;

    public function table(Table $table): Table
    {
        $district = $this->getOwnerRecord();
        $province = $district->province;
        $country = $province->country;

        return $table
            ->recordTitleAttribute('name')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.geo_data.sub_districts.fields.name'))
                    ->searchable()
                    ->sortable(),
            ])
            ->headerActions([
                Actions\CreateAction::make()
                    ->url(fn (): string => SubDistrictResource::getUrl('create', [
                        'country' => $country,
                        'province' => $province,
                        'district' => $district,
                    ])),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => SubDistrictResource::getUrl('edit', [
                        'country' => $country,
                        'province' => $province,
                        'district' => $district,
                        'record' => $record,
                    ])),
                Actions\DeleteAction::make(),
            ]);
    }
}
