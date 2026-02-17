<?php

namespace App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Schemas;

use App\Models\User;
use Filament\Forms;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Hidden::make('department_id'),
                Forms\Components\TextInput::make('code')
                    ->label(__('filament.resources.companies.employees.fields.code'))
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.companies.employees.fields.name'))
                    ->required(),
                Forms\Components\TextInput::make('id_no')
                    ->label(__('filament.resources.companies.employees.fields.id_no')),
                Forms\Components\TextInput::make('phone_no')
                    ->label(__('filament.resources.companies.employees.fields.phone_no')),
                Forms\Components\TextInput::make('email_address')
                    ->label(__('filament.resources.companies.employees.fields.email_address'))
                    ->email(),
                Forms\Components\Select::make('user_id')
                    ->label(__('filament.resources.companies.employees.fields.user'))
                    ->options(User::all()->pluck('name', 'id'))
                    ->nullable(),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('filament.resources.companies.employees.fields.is_active'))
                    ->default(true),
            ]);
    }
}
