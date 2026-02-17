<?php

namespace App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\Pages;

use App\Filament\Resources\Companies\Resources\Departments\Resources\Employees\EmployeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
}
