<?php

namespace App\Filament\Resources\Companies\Resources\Departments\Pages;

use App\Filament\Resources\Companies\Resources\Departments\DepartmentResource;
use Filament\Resources\Pages\ListRecords;

class ListDepartments extends ListRecords
{
    protected static string $resource = DepartmentResource::class;
}
