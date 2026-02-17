<?php

namespace App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Pages;

use App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\EmployeeResource;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;
}
