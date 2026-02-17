<?php

namespace App\Filament\Resources\Companies\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.resources.companies.fields.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email_address')
                    ->label(__('filament.resources.companies.fields.email_address'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('filament.resources.companies.fields.phone'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('country.name')
                    ->label(__('filament.resources.companies.fields.country'))
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ]);
    }
}
