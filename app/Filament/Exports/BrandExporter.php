<?php

namespace App\Filament\Exports;

use App\Models\Brand;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class BrandExporter extends Exporter
{
    protected static ?string $model = Brand::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label(__('filament.resources.brands.fields.id')),
            ExportColumn::make('name')
                ->label(__('filament.resources.brands.fields.name')),
            ExportColumn::make('slug')
                ->label(__('filament.resources.brands.fields.slug')),
            ExportColumn::make('description')
                ->label(__('filament.resources.brands.fields.description')),
            ExportColumn::make('category.name')
                ->label(__('filament.resources.brands.fields.item_category')),
            ExportColumn::make('logo_url')
                ->label(__('filament.resources.brands.fields.logo_url')),
            ExportColumn::make('created_at')
                ->label(__('filament.resources.brands.fields.created_at')),
            ExportColumn::make('updated_at')
                ->label(__('filament.resources.brands.fields.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your brand export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
