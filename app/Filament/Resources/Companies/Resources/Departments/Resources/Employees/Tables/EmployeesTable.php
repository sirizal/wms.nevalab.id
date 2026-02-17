<?php

namespace App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label(__('filament.resources.companies.employees.fields.code'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.companies.employees.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_no')
                    ->label(__('filament.resources.companies.employees.fields.id_no'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('phone_no')
                    ->label(__('filament.resources.companies.employees.fields.phone_no'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email_address')
                    ->label(__('filament.resources.companies.employees.fields.email_address'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.resources.companies.employees.fields.is_active'))
                    ->boolean(),
            ])
            ->filters([
                //
            ]);
    }
}
