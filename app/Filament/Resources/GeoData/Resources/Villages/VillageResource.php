<?php

namespace App\Filament\Resources\GeoData\Resources\Villages;

use App\Filament\Resources\GeoData\Resources\SubDistricts\SubDistrictResource;
use App\Filament\Resources\GeoData\Resources\Villages\Pages\CreateVillage;
use App\Filament\Resources\GeoData\Resources\Villages\Pages\EditVillage;
use App\Filament\Resources\GeoData\Resources\Villages\Pages\ListVillages;
use App\Filament\Resources\GeoData\Resources\Villages\Schemas\VillageForm;
use App\Filament\Resources\GeoData\Resources\Villages\Tables\VillagesTable;
use App\Models\Village;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VillageResource extends Resource
{
    protected static ?string $model = Village::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $parentResource = SubDistrictResource::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.geo_data.villages.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.geo_data.villages.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'postal_code'];
    }

    public static function form(Schema $schema): Schema
    {
        return VillageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VillagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVillages::route('/'),
            'create' => CreateVillage::route('/create'),
            'edit' => EditVillage::route('/{record}/edit'),
        ];
    }
}
