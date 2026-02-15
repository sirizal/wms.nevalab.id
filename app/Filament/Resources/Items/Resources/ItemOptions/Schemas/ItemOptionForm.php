<?php

namespace App\Filament\Resources\Items\Resources\ItemOptions\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class ItemOptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('item_id'),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.items.relations.item_options.fields.name'))
                    ->required(),
            ]);
    }
}
