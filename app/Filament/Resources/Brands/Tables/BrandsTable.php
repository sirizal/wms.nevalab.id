<?php

namespace App\Filament\Resources\Brands\Tables;

use App\Filament\Exports\BrandExporter;
use App\Models\ItemCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BrandsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.resources.brands.fields.name'))
                    ->searchable(),
                TextColumn::make('slug')
                    ->label(__('filament.resources.brands.fields.slug'))
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label(__('filament.resources.brands.fields.item_category'))
                    ->searchable(),
                ImageColumn::make('logo_url')
                    ->label(__('filament.resources.brands.fields.logo_url'))
                    ->disk('public')
                    ->visibility('public'),
                TextColumn::make('created_at')
                    ->label(__('filament.resources.brands.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament.resources.brands.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('item_category_id')
                    ->label(__('filament.resources.brands.fields.item_category'))
                    ->options(fn () => ItemCategory::whereNull('parent_category_id')
                        ->pluck('name', 'id')),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(BrandExporter::class),
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
