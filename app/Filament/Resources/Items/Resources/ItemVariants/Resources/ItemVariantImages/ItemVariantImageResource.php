<?php

namespace App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages;

use App\Filament\Resources\Items\Resources\ItemVariants\ItemVariantResource;
use App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\Pages\CreateItemVariantImage;
use App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\Pages\EditItemVariantImage;
use App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\Pages\ListItemVariantImages;
use App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\Schemas\ItemVariantImageForm;
use App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\Tables\ItemVariantImagesTable;
use App\Models\ItemVariantImage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ItemVariantImageResource extends Resource
{
    protected static ?string $model = ItemVariantImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $recordTitleAttribute = 'image';

    protected static ?string $parentResource = ItemVariantResource::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.items.relations.item_variant_images.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.items.relations.item_variant_images.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['image'];
    }

    public static function form(Schema $schema): Schema
    {
        return ItemVariantImageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ItemVariantImagesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListItemVariantImages::route('/'),
            'create' => CreateItemVariantImage::route('/create'),
            'edit' => EditItemVariantImage::route('/{record}/edit'),
        ];
    }
}
