<?php

namespace App\Filament\Exports;

use App\Models\Item;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ItemExporter extends Exporter
{
    protected static ?string $model = Item::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label(__('filament.resources.items.fields.id')),
            ExportColumn::make('name')
                ->label(__('filament.resources.items.fields.name')),
            ExportColumn::make('slug')
                ->label(__('filament.resources.items.fields.slug')),
            ExportColumn::make('description')
                ->label(__('filament.resources.items.fields.description')),
            ExportColumn::make('category.name')
                ->label(__('filament.resources.items.fields.item_category')),
            ExportColumn::make('brand.name')
                ->label(__('filament.resources.items.fields.brand')),
            ExportColumn::make('uom.name')
                ->label(__('filament.resources.items.fields.uom')),
            ExportColumn::make('is_active')
                ->label(__('filament.resources.items.fields.is_active')),
            ExportColumn::make('created_at')
                ->label(__('filament.resources.items.fields.created_at')),
            ExportColumn::make('updated_at')
                ->label(__('filament.resources.items.fields.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your item export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
