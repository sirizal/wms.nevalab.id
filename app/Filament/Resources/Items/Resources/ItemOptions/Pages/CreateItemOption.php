<?php

namespace App\Filament\Resources\Items\Resources\ItemOptions\Pages;

use App\Filament\Resources\Items\Resources\ItemOptions\ItemOptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateItemOption extends CreateRecord
{
    protected static string $resource = ItemOptionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['item_id'] = $this->getParentRecord()->id;

        return $data;
    }
}
