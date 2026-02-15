<?php

namespace App\Filament\Resources\ItemCategories\Schemas;

use App\Models\ItemCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ItemCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.resources.item_categories.fields.name'))
                    ->unique(ItemCategory::class, 'name', ignoreRecord: true)
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str($state)->slug())),
                TextInput::make('slug')
                    ->label(__('filament.resources.item_categories.fields.slug'))
                    ->unique(ItemCategory::class, 'slug', ignoreRecord: true)
                    ->required(),
                Textarea::make('description')
                    ->label(__('filament.resources.item_categories.fields.description'))
                    ->columnSpanFull(),
                Select::make('parent_category_id')
                    ->label(__('filament.resources.item_categories.fields.parent_category'))
                    ->relationship('parentCategory', 'name')
                    ->options(fn ($get) => ItemCategory::whereNull('parent_category_id')
                        ->where('id', '!=', $get('../id'))
                        ->pluck('name', 'id'))
                    ->preload()
                    ->searchable(),
            ]);
    }
}
