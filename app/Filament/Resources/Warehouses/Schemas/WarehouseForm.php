<?php

namespace App\Filament\Resources\Warehouses\Schemas;

use App\Models\Company;
use App\Models\Country;
use App\Models\District;
use App\Models\Employee;
use App\Models\Province;
use App\Models\SubDistrict;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class WarehouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->label(__('filament.resources.warehouses.fields.company'))
                    ->options(fn () => Company::query()->pluck('name', 'id'))
                    ->required()
                    ->preload(),
                Forms\Components\TextInput::make('code')
                    ->label(__('filament.resources.warehouses.fields.code'))
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.warehouses.fields.name'))
                    ->required(),
                Select::make('person_in_charge_id')
                    ->label(__('filament.resources.warehouses.fields.person_in_charge'))
                    ->options(fn () => Employee::query()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
                Forms\Components\TextInput::make('phone_no')
                    ->label(__('filament.resources.warehouses.fields.phone_no'))
                    ->tel(),
                Forms\Components\Textarea::make('address')
                    ->label(__('filament.resources.warehouses.fields.address')),
                Select::make('country_id')
                    ->label(__('filament.resources.warehouses.fields.country'))
                    ->options(fn () => Country::query()->pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('province_id', null);
                        $set('district_id', null);
                        $set('sub_district_id', null);
                        $set('village_id', null);
                        $set('postal_code', null);
                    }),
                Select::make('province_id')
                    ->label(__('filament.resources.warehouses.fields.province'))
                    ->options(fn (Get $get) => Province::query()
                        ->where('country_id', $get('country_id'))
                        ->pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('district_id', null);
                        $set('sub_district_id', null);
                        $set('village_id', null);
                        $set('postal_code', null);
                    }),
                Select::make('district_id')
                    ->label(__('filament.resources.warehouses.fields.district'))
                    ->options(fn (Get $get) => District::query()
                        ->where('province_id', $get('province_id'))
                        ->pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('sub_district_id', null);
                        $set('village_id', null);
                        $set('postal_code', null);
                    }),
                Select::make('sub_district_id')
                    ->label(__('filament.resources.warehouses.fields.sub_district'))
                    ->options(fn (Get $get) => SubDistrict::query()
                        ->where('district_id', $get('district_id'))
                        ->pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('village_id', null);
                        $set('postal_code', null);
                    }),
                Select::make('village_id')
                    ->label(__('filament.resources.warehouses.fields.village'))
                    ->options(fn (Get $get) => Village::query()
                        ->where('sub_district_id', $get('sub_district_id'))
                        ->pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $villageId = $get('village_id');
                        if ($villageId) {
                            $village = Village::find($villageId);
                            if ($village) {
                                $set('postal_code', $village->postal_code);
                            }
                        } else {
                            $set('postal_code', null);
                        }
                    }),
                Forms\Components\TextInput::make('postal_code')
                    ->label(__('filament.resources.warehouses.fields.postal_code')),
                Forms\Components\TextInput::make('latitude')
                    ->label(__('filament.resources.warehouses.fields.latitude'))
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->label(__('filament.resources.warehouses.fields.longitude'))
                    ->numeric(),
                Forms\Components\Toggle::make('is_rent')
                    ->label(__('filament.resources.warehouses.fields.is_rent')),
                Forms\Components\TextInput::make('rent_period')
                    ->label(__('filament.resources.warehouses.fields.rent_period'))
                    ->numeric(),
                Forms\Components\TextInput::make('rent_cost')
                    ->label(__('filament.resources.warehouses.fields.rent_cost'))
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\DateTimePicker::make('rent_expired')
                    ->label(__('filament.resources.warehouses.fields.rent_expired')),
                Forms\Components\TextInput::make('square_meter')
                    ->label(__('filament.resources.warehouses.fields.square_meter'))
                    ->numeric(),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('filament.resources.warehouses.fields.is_active'))
                    ->default(true),
            ]);
    }
}
