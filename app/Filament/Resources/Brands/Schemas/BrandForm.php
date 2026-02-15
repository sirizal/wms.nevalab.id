<?php

namespace App\Filament\Resources\Brands\Schemas;

use App\Models\Brand;
use App\Models\ItemCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.resources.brands.fields.name'))
                    ->unique(Brand::class, 'name', ignoreRecord: true)
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str($state)->slug())),
                TextInput::make('slug')
                    ->label(__('filament.resources.brands.fields.slug'))
                    ->unique(Brand::class, 'slug', ignoreRecord: true)
                    ->required(),
                Textarea::make('description')
                    ->label(__('filament.resources.brands.fields.description'))
                    ->columnSpanFull(),
                Select::make('item_category_id')
                    ->label(__('filament.resources.brands.fields.item_category'))
                    ->relationship('category', 'name')
                    ->options(fn () => ItemCategory::whereNull('parent_category_id')
                        ->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->required(),
                FileUpload::make('logo_url')
                    ->label(__('filament.resources.brands.fields.logo_url'))
                    ->image()
                    ->disk('public')
                    ->directory('brands')
                    ->visibility('public')
                    ->maxSize(1024),
            ]);
    }
}
