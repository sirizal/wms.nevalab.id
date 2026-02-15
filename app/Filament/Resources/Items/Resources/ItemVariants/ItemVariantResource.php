<?php

namespace App\Filament\Resources\Items\Resources\ItemVariants;

use App\Filament\Resources\Items\ItemResource;
use App\Filament\Resources\Items\Resources\ItemVariants\Pages\CreateItemVariant;
use App\Filament\Resources\Items\Resources\ItemVariants\Pages\EditItemVariant;
use App\Filament\Resources\Items\Resources\ItemVariants\Pages\ListItemVariants;
use App\Filament\Resources\Items\Resources\ItemVariants\Schemas\ItemVariantForm;
use App\Filament\Resources\Items\Resources\ItemVariants\Tables\ItemVariantsTable;
use App\Models\ItemVariant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ItemVariantResource extends Resource
{
    protected static ?string $model = ItemVariant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $parentResource = ItemResource::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.items.relations.item_variants.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.items.relations.item_variants.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['sku', 'name', 'customer_code'];
    }

    public static function form(Schema $schema): Schema
    {
        return ItemVariantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemVariantsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\Items\RelationManagers\ItemVariantImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItemVariants::route('/'),
            'create' => CreateItemVariant::route('/create'),
            'edit' => EditItemVariant::route('/{record}/edit'),
        ];
    }
}
