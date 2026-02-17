<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SkippedItemsExport implements FromCollection, WithHeadings
{
    public function __construct(public array $skippedRows) {}

    public function collection(): Collection
    {
        return collect($this->skippedRows);
    }

    public function headings(): array
    {
        return ['name', 'slug', 'customer_code', 'description', 'main_image', 'item_category', 'brand', 'uom', 'is_active', 'remark'];
    }
}
