<?php

namespace App\Filament\Resources\Companies\Resources\Departments\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class DepartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.companies.departments.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('superior.name')
                    ->label(__('filament.resources.companies.departments.fields.superior'))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('employees_count')
                    ->label(__('filament.resources.companies.departments.fields.employees_count'))
                    ->counts('employees'),
            ])
            ->filters([
                //
            ]);
    }
}
