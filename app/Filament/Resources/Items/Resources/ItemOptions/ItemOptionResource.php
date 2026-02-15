<?php

namespace App\Filament\Resources\Items\Resources\ItemOptions;

use App\Filament\Resources\Items\ItemResource;
use App\Filament\Resources\Items\Resources\ItemOptions\Pages\CreateItemOption;
use App\Filament\Resources\Items\Resources\ItemOptions\Pages\EditItemOption;
use App\Filament\Resources\Items\Resources\ItemOptions\Pages\ListItemOptions;
use App\Filament\Resources\Items\Resources\ItemOptions\Schemas\ItemOptionForm;
use App\Filament\Resources\Items\Resources\ItemOptions\Tables\ItemOptionsTable;
use App\Models\ItemOption;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ItemOptionResource extends Resource
{
    protected static ?string $model = ItemOption::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $parentResource = ItemResource::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.items.relations.item_options.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.items.relations.item_options.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function form(Schema $schema): Schema
    {
        return ItemOptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemOptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\Items\RelationManagers\ItemOptionValuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItemOptions::route('/'),
            'create' => CreateItemOption::route('/create'),
            'edit' => EditItemOption::route('/{record}/edit'),
        ];
    }
}
