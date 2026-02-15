<?php

namespace App\Filament\Resources\Uoms;

use App\Filament\Resources\Uoms\Pages\CreateUom;
use App\Filament\Resources\Uoms\Pages\EditUom;
use App\Filament\Resources\Uoms\Pages\ListUoms;
use App\Filament\Resources\Uoms\Schemas\UomForm;
use App\Filament\Resources\Uoms\Tables\UomsTable;
use App\Models\Uom;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UomResource extends Resource
{
    protected static ?string $model = Uom::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return __('filament.resources.uoms.uom.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.uoms.uom.plural_model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.resources.uoms.uom.navigation_group');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'symbol'];
    }

    public static function form(Schema $schema): Schema
    {
        return UomForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UomsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUoms::route('/'),
            'create' => CreateUom::route('/create'),
            'edit' => EditUom::route('/{record}/edit'),
        ];
    }
}
