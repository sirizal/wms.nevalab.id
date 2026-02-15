<?php

namespace App\Filament\Resources\Items\Resources\ItemVariants\Pages;

use App\Filament\Resources\Items\Resources\ItemVariants\ItemVariantResource;
use Filament\Resources\Pages\CreateRecord;

class CreateItemVariant extends CreateRecord
{
    protected static string $resource = ItemVariantResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['item_id'] = $this->getParentRecord()->id;

        return $data;
    }
}
