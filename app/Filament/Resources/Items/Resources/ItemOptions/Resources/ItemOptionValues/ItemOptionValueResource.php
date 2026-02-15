<?php

namespace App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues;

use App\Filament\Resources\Items\Resources\ItemOptions\ItemOptionResource;
use App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\Pages\CreateItemOptionValue;
use App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\Pages\EditItemOptionValue;
use App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\Pages\ListItemOptionValues;
use App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\Schemas\ItemOptionValueForm;
use App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\Tables\ItemOptionValuesTable;
use App\Models\ItemOptionValue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ItemOptionValueResource extends Resource
{
    protected static ?string $model = ItemOptionValue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheck;

    protected static ?string $recordTitleAttribute = 'value';

    protected static ?string $parentResource = ItemOptionResource::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.items.relations.item_option_values.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.items.relations.item_option_values.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['value'];
    }

    public static function form(Schema $schema): Schema
    {
        return ItemOptionValueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemOptionValuesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItemOptionValues::route('/'),
            'create' => CreateItemOptionValue::route('/create'),
            'edit' => EditItemOptionValue::route('/{record}/edit'),
        ];
    }
}
