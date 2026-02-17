<?php

namespace App\Filament\Resources\GeoData\Resources\Countries;

use App\Filament\Resources\GeoData\Resources\Countries\Pages\CreateCountry;
use App\Filament\Resources\GeoData\Resources\Countries\Pages\EditCountry;
use App\Filament\Resources\GeoData\Resources\Countries\Pages\ListCountries;
use App\Filament\Resources\GeoData\Resources\Countries\Schemas\CountryForm;
use App\Filament\Resources\GeoData\Resources\Countries\Tables\CountriesTable;
use App\Models\Country;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    protected static ?string $recordTitleAttribute = 'name';

    protected static bool $shouldRegisterNavigation = true;

    public static function getModelLabel(): string
    {
        return __('filament.resources.geo_data.countries.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.geo_data.countries.plural_model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.resources.geo_data.navigation_group');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'code'];
    }

    public static function form(Schema $schema): Schema
    {
        return CountryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CountriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProvincesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCountries::route('/'),
            'create' => CreateCountry::route('/create'),
            'edit' => EditCountry::route('/{record}/edit'),
        ];
    }
}
