<?php

namespace App\Filament\Resources\Items\Tables;

use App\Filament\Exports\ItemExporter;
use App\Models\Brand;
use App\Models\ItemCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.resources.items.fields.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label(__('filament.resources.items.fields.slug'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer_code')
                    ->label(__('filament.resources.items.fields.customer_code'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label(__('filament.resources.items.fields.item_category'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('brand.name')
                    ->label(__('filament.resources.items.fields.brand'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('uom.name')
                    ->label(__('filament.resources.items.fields.uom'))
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('main_image')
                    ->label(__('filament.resources.items.fields.main_image'))
                    ->disk('public')
                    ->visibility('public'),
                IconColumn::make('is_active')
                    ->label(__('filament.resources.items.fields.is_active'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(__('filament.resources.items.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament.resources.items.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('item_category_id')
                    ->label(__('filament.resources.items.fields.item_category'))
                    ->options(fn () => ItemCategory::whereNotNull('parent_category_id')
                        ->pluck('name', 'id')),
                SelectFilter::make('brand_id')
                    ->label(__('filament.resources.items.fields.brand'))
                    ->options(fn () => Brand::pluck('name', 'id')),
                TernaryFilter::make('is_active')
                    ->label(__('filament.resources.items.fields.is_active')),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(ItemExporter::class),
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
