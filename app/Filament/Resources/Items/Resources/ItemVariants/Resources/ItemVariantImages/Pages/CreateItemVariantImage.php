<?php

namespace App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\Pages;

use App\Filament\Resources\Items\Resources\ItemVariants\Resources\ItemVariantImages\ItemVariantImageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateItemVariantImage extends CreateRecord
{
    protected static string $resource = ItemVariantImageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['item_variant_id'] = $this->getParentRecord()->id;

        return $data;
    }
}
