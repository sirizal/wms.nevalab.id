<?php

namespace App\Filament\Resources\Items\Schemas;

use App\Models\Brand;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Uom;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.resources.items.fields.name'))
                    ->unique(Item::class, 'name', ignoreRecord: true)
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str($state)->slug())),
                TextInput::make('slug')
                    ->label(__('filament.resources.items.fields.slug'))
                    ->unique(Item::class, 'slug', ignoreRecord: true)
                    ->required(),
                Textarea::make('description')
                    ->label(__('filament.resources.items.fields.description'))
                    ->columnSpanFull(),
                Select::make('item_category_id')
                    ->label(__('filament.resources.items.fields.item_category'))
                    ->options(fn () => ItemCategory::whereNotNull('parent_category_id')
                        ->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->required(),
                Select::make('brand_id')
                    ->label(__('filament.resources.items.fields.brand'))
                    ->options(fn () => Brand::pluck('name', 'id'))
                    ->preload()
                    ->searchable(),
                Select::make('uom_id')
                    ->label(__('filament.resources.items.fields.uom'))
                    ->options(fn () => Uom::pluck('name', 'id'))
                    ->preload()
                    ->searchable(),
                Toggle::make('is_active')
                    ->label(__('filament.resources.items.fields.is_active'))
                    ->default(true),
            ]);
    }
}
