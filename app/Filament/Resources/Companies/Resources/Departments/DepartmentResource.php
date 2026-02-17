<?php

namespace App\Filament\Resources\Companies\Resources\Departments;

use App\Filament\Resources\Companies\Resources\Departments\Pages\CreateDepartment;
use App\Filament\Resources\Companies\Resources\Departments\Pages\EditDepartment;
use App\Filament\Resources\Companies\Resources\Departments\Pages\ListDepartments;
use App\Filament\Resources\Companies\Resources\Departments\Schemas\DepartmentForm;
use App\Filament\Resources\Companies\Resources\Departments\Tables\DepartmentsTable;
use App\Models\Department;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'name';

    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return __('filament.resources.companies.departments.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.companies.departments.plural_model_label');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function form(Schema $schema): Schema
    {
        return DepartmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DepartmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\EmployeesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDepartments::route('/'),
            'create' => CreateDepartment::route('/create'),
            'edit' => EditDepartment::route('/{record}/edit'),
        ];
    }
}
