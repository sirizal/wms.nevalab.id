<?php

namespace App\Filament\Resources\Companies\Resources\Departments\RelationManagers;

use App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Schemas\EmployeeForm;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    public function form(Schema $schema): Schema
    {
        return EmployeeForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('code')
                    ->label(__('filament.resources.companies.employees.fields.code'))
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.companies.employees.fields.name'))
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('id_no')
                    ->label(__('filament.resources.companies.employees.fields.id_no'))
                    ->searchable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('phone_no')
                    ->label(__('filament.resources.companies.employees.fields.phone_no'))
                    ->searchable()
                    ->toggleable(),
                \Filament\Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.resources.companies.employees.fields.is_active'))
                    ->boolean(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                Actions\DeleteAction::make(),
            ]);
    }
}
