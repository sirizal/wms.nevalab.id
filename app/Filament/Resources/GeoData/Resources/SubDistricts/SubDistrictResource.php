<?php

namespace App\Filament\Resources\GeoData\Resources\SubDistricts;

use App\Filament\Resources\GeoData\Resources\Districts\DistrictResource;
use App\Filament\Resources\GeoData\Resources\SubDistricts\Pages\CreateSubDistrict;
use App\Filament\Resources\GeoData\Resources\SubDistricts\Pages\EditSubDistrict;
use App\Filament\Resources\GeoData\Resources\SubDistricts\Pages\ListSubDistricts;
use App\Filament\Resources\GeoData\Resources\SubDistricts\Schemas\SubDistrictForm;
use App\Filament\Resources\GeoData\Resources\SubDistricts\Tables\SubDistrictsTable;
use App\Models\SubDistrict;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubDistrictResource extends Resource
{
    protected static ?string $model = SubDistrict::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $parentResource = DistrictResource::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.geo_data.sub_districts.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.geo_data.sub_districts.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function form(Schema $schema): Schema
    {
        return SubDistrictForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubDistrictsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VillagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubDistricts::route('/'),
            'create' => CreateSubDistrict::route('/create'),
            'edit' => EditSubDistrict::route('/{record}/edit'),
        ];
    }
}
