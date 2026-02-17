<?php

namespace App\Filament\Resources\Companies\Resources\Departments\Schemas;

use App\Models\Employee;
use Filament\Forms;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('company_id'),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.companies.departments.fields.name'))
                    ->required(),
                Forms\Components\Select::make('superior_id')
                    ->label(__('filament.resources.companies.departments.fields.superior'))
                    ->options(fn ($record) => Employee::whereHas('department', fn ($query) => $query->where('company_id', $record?->company_id))
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
            ]);
    }
}
