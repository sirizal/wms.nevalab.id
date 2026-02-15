<?php

namespace App\Filament\Resources\ItemCategories\Tables;

use App\Filament\Exports\ItemCategoryExporter;
use App\Models\ItemCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ItemCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.resources.item_categories.fields.name'))
                    ->searchable(),
                TextColumn::make('slug')
                    ->label(__('filament.resources.item_categories.fields.slug'))
                    ->searchable(),
                TextColumn::make('parentCategory.name')
                    ->label(__('filament.resources.item_categories.fields.parent_category'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament.resources.item_categories.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament.resources.item_categories.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('parent_category_id')
                    ->label(__('filament.resources.item_categories.fields.parent_category'))
                    ->options(fn () => ItemCategory::whereNull('parent_category_id')
                        ->pluck('name', 'id')),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(ItemCategoryExporter::class),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
