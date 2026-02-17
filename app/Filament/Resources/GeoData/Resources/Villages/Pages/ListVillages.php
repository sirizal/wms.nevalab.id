<?php

namespace App\Filament\Resources\GeoData\Resources\Villages\Pages;

use App\Filament\Resources\GeoData\Resources\Villages\VillageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVillages extends ListRecords
{
    protected static string $resource = VillageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
