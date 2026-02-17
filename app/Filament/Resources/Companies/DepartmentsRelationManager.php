<?php

namespace App\Filament\Resources\Companies;

use App\Filament\Resources\Companies\Resources\Departments\DepartmentResource;
use App\Filament\Resources\Companies\Resources\Departments\Schemas\DepartmentForm;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class DepartmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'departments';

    public function form(Schema $schema): Schema
    {
        return DepartmentForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.companies.departments.fields.name'))
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('superior.name')
                    ->label(__('filament.resources.companies.departments.fields.superior'))
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('employees_count')
                    ->label(__('filament.resources.companies.departments.fields.employees_count'))
                    ->counts('employees'),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn ($record): string => DepartmentResource::getUrl('edit', [
                        'record' => $record,
                    ])),
            ]);
    }
}
