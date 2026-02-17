<?php

namespace App\Filament\Resources\GeoData\Resources\Provinces;

use App\Filament\Resources\GeoData\Resources\Countries\CountryResource;
use App\Filament\Resources\GeoData\Resources\Provinces\Pages\CreateProvince;
use App\Filament\Resources\GeoData\Resources\Provinces\Pages\EditProvince;
use App\Filament\Resources\GeoData\Resources\Provinces\Pages\ListProvinces;
use App\Filament\Resources\GeoData\Resources\Provinces\Schemas\ProvinceForm;
use App\Filament\Resources\GeoData\Resources\Provinces\Tables\ProvincesTable;
use App\Models\Province;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProvinceResource extends Resource
{
    protected static ?string $model = Province::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $parentResource = CountryResource::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.geo_data.provinces.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.geo_data.provinces.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function form(Schema $schema): Schema
    {
        return ProvinceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProvincesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DistrictsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProvinces::route('/'),
            'create' => CreateProvince::route('/create'),
            'edit' => EditProvince::route('/{record}/edit'),
        ];
    }
}
