<?php

namespace App\Filament\Resources\Uoms\Schemas;

use App\Models\Uom;
use App\Models\UomType;
use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament.resources.uoms.fields.name'))
                    ->unique(Uom::class, 'name', ignoreRecord: true)
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament.resources.uoms.fields.code'))
                    ->unique(Uom::class, 'code', ignoreRecord: true)
                    ->required()
                    ->autocapitalize('words'),
                TextInput::make('symbol')
                    ->label(__('filament.resources.uoms.fields.symbol'))
                    ->unique(Uom::class, 'symbol', ignoreRecord: true)
                    ->required(),
                Select::make('uom_type_id')
                    ->label(__('filament.resources.uoms.fields.uom_type'))
                    ->relationship('uomType', 'name')
                    ->required()
                    ->preload(true)
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label(__('filament.resources.uom_types.fields.name'))
                            ->required()
                            ->unique(UomType::class, 'name'),
                    ]),
                Select::make('base_uom_id')
                    ->label(__('filament.resources.uoms.fields.base_uom'))
                    ->relationship('baseUom', 'name')
                    ->options(fn ($get) => Uom::where('id', '!=', $get('../id'))
                        ->pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(function ($component, $state) {
                        $container = $component->getContainer();
                        $conversionField = $container->getComponent('conversionFactorField');
                        if ($conversionField) {
                            if ($state === null) {
                                $conversionField->getChildSchema()->default(1)->disabled(true);
                            } else {
                                $conversionField->getChildSchema()->disabled(false);
                            }
                            $conversionField->getChildSchema()->fill();
                        }
                    })
                    ->rules([
                        fn (): Closure => function (string $attribute, $value, Closure $fail) {
                            if ($value === null) {
                                return;
                            }

                            $currentRecordId = (int) request()->route('record');

                            if ($currentRecordId === 0) {
                                return;
                            }

                            if ((int) $value === $currentRecordId) {
                                $fail(__('filament.resources.uoms.validation.uom_cannot_be_own_base'));
                            }

                            $selectedUom = Uom::with('baseUom')->find($value);

                            if (! $selectedUom) {
                                return;
                            }

                            $current = $selectedUom;
                            while ($current->baseUom) {
                                if ($current->baseUom->id === $currentRecordId) {
                                    $fail(__('filament.resources.uoms.validation.circular_reference'));
                                }
                                $current = $current->baseUom;
                            }
                        },
                    ])
                    ->key('baseUomSelect'),
                TextInput::make('conversion_factor')
                    ->label(__('filament.resources.uoms.fields.conversion_factor'))
                    ->required()
                    ->numeric()
                    ->live()
                    ->key('conversionFactorField')
                    ->default(1)
                    ->disabled(fn ($get) => $get('base_uom_id') === null),
            ]);
    }
}
