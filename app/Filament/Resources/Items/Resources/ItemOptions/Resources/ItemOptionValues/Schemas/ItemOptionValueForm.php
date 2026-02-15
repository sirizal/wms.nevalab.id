<?php

namespace App\Filament\Resources\Items\Resources\ItemOptions\Resources\ItemOptionValues\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class ItemOptionValueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('item_option_id'),
                Forms\Components\TextInput::make('value')
                    ->label(__('filament.resources.items.relations.item_option_values.fields.value'))
                    ->required(),
            ]);
    }
}
