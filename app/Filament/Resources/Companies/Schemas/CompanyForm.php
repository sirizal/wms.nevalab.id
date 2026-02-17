<?php

namespace App\Filament\Resources\Companies\Schemas;

use App\Models\Country;
use App\Models\District;
use App\Models\Province;
use App\Models\SubDistrict;
use App\Models\Village;
use Filament\Forms;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.resources.companies.fields.name'))
                    ->required(),
                Forms\Components\TextInput::make('contact')
                    ->label(__('filament.resources.companies.fields.contact')),
                Forms\Components\TextInput::make('email_address')
                    ->label(__('filament.resources.companies.fields.email_address'))
                    ->email(),
                Forms\Components\TextInput::make('phone')
                    ->label(__('filament.resources.companies.fields.phone')),
                Forms\Components\TextInput::make('website')
                    ->label(__('filament.resources.companies.fields.website'))
                    ->url(),
                Forms\Components\Textarea::make('address')
                    ->label(__('filament.resources.companies.fields.address')),
                Forms\Components\Select::make('country_id')
                    ->label(__('filament.resources.companies.fields.country'))
                    ->options(fn () => Country::query()->pluck('name', 'id')),
                Forms\Components\Select::make('province_id')
                    ->label(__('filament.resources.companies.fields.province'))
                    ->options(fn () => Province::query()->pluck('name', 'id')),
                Forms\Components\Select::make('district_id')
                    ->label(__('filament.resources.companies.fields.district'))
                    ->options(fn () => District::query()->pluck('name', 'id')),
                Forms\Components\Select::make('sub_district_id')
                    ->label(__('filament.resources.companies.fields.sub_district'))
                    ->options(fn () => SubDistrict::query()->pluck('name', 'id')),
                Forms\Components\Select::make('village_id')
                    ->label(__('filament.resources.companies.fields.village'))
                    ->options(fn () => Village::query()->pluck('name', 'id')),
                Forms\Components\TextInput::make('postal_code')
                    ->label(__('filament.resources.companies.fields.postal_code')),
                Forms\Components\TextInput::make('tax_no')
                    ->label(__('filament.resources.companies.fields.tax_no')),
            ]);
    }
}
