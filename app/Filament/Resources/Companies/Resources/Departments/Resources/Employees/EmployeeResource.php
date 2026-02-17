<?php

namespace App\Filament\Resources\Companies\Resources\Departments\Resources\Employees;

use App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Pages\CreateEmployee;
use App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Pages\EditEmployee;
use App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Pages\ListEmployees;
use App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Schemas\EmployeeForm;
use App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Tables\EmployeesTable;
use App\Models\Employee;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $recordTitleAttribute = 'name';

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.companies.employees.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.companies.employees.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'code', 'id_no', 'email_address'];
    }

    public static function form(Schema $schema): Schema
    {
        return EmployeeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployeesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmployees::route('/'),
            'create' => CreateEmployee::route('/create'),
            'edit' => EditEmployee::route('/{record}/edit'),
        ];
    }
}
