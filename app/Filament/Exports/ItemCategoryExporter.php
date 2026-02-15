<?php

namespace App\Filament\Exports;

use App\Models\ItemCategory;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ItemCategoryExporter extends Exporter
{
    protected static ?string $model = ItemCategory::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label(__('filament.resources.item_categories.fields.id')),
            ExportColumn::make('name')
                ->label(__('filament.resources.item_categories.fields.name')),
            ExportColumn::make('slug')
                ->label(__('filament.resources.item_categories.fields.slug')),
            ExportColumn::make('description')
                ->label(__('filament.resources.item_categories.fields.description')),
            ExportColumn::make('parentCategory.name')
                ->label(__('filament.resources.item_categories.fields.parent_category')),
            ExportColumn::make('created_at')
                ->label(__('filament.resources.item_categories.fields.created_at')),
            ExportColumn::make('updated_at')
                ->label(__('filament.resources.item_categories.fields.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your item category export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
