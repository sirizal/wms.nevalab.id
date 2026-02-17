<?php

namespace App\Filament\Resources\GeoData\Resources\Districts;

use App\Filament\Resources\GeoData\Resources\Districts\Pages\CreateDistrict;
use App\Filament\Resources\GeoData\Resources\Districts\Pages\EditDistrict;
use App\Filament\Resources\GeoData\Resources\Districts\Pages\ListDistricts;
use App\Filament\Resources\GeoData\Resources\Districts\Schemas\DistrictForm;
use App\Filament\Resources\GeoData\Resources\Districts\Tables\DistrictsTable;
use App\Filament\Resources\GeoData\Resources\Provinces\ProvinceResource;
use App\Models\District;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DistrictResource extends Resource
{
    protected static ?string $model = District::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $parentResource = ProvinceResource::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.geo_data.districts.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.geo_data.districts.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function form(Schema $schema): Schema
    {
        return DistrictForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DistrictsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SubDistrictsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDistricts::route('/'),
            'create' => CreateDistrict::route('/create'),
            'edit' => EditDistrict::route('/{record}/edit'),
        ];
    }
}
