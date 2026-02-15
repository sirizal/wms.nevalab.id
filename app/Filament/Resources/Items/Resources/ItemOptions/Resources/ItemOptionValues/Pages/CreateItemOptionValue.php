<?php

namespace App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\Pages;

use App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\ItemOptionValueResource;
use Filament\Resources\Pages\CreateRecord;

class CreateItemOptionValue extends CreateRecord
{
    protected static string $resource = ItemOptionValueResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['item_option_id'] = $this->getParentRecord()->id;

        return $data;
    }
}
