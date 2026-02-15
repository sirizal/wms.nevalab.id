<?php

namespace Database\Seeders;

use App\Models\Uom;
use App\Models\UomType;
use Illuminate\Database\Seeder;

class UomSeeder extends Seeder
{
    public function run(): void
    {
        $lengthType = UomType::create([
            'name' => 'Length',
        ]);

        $weightType = UomType::create([
            'name' => 'Weight',
        ]);

        $volumeType = UomType::create([
            'name' => 'Volume',
        ]);

        $quantityType = UomType::create([
            'name' => 'Quantity',
        ]);

        $meter = Uom::create([
            'name' => 'Meter',
            'code' => 'M',
            'symbol' => 'm',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Centimeter',
            'code' => 'CM',
            'symbol' => 'cm',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 0.01,
            'base_uom_id' => $meter->id,
        ]);

        Uom::create([
            'name' => 'Millimeter',
            'code' => 'MM',
            'symbol' => 'mm',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 0.001,
            'base_uom_id' => $meter->id,
        ]);

        Uom::create([
            'name' => 'Kilometer',
            'code' => 'KM',
            'symbol' => 'km',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 1000,
            'base_uom_id' => $meter->id,
        ]);

        Uom::create([
            'name' => 'Inch',
            'code' => 'IN',
            'symbol' => 'in',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 0.0254,
            'base_uom_id' => $meter->id,
        ]);

        Uom::create([
            'name' => 'Foot',
            'code' => 'FT',
            'symbol' => 'ft',
            'uom_type_id' => $lengthType->id,
            'conversion_factor' => 0.3048,
            'base_uom_id' => $meter->id,
        ]);

        $kilogram = Uom::create([
            'name' => 'Kilogram',
            'code' => 'KG',
            'symbol' => 'kg',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Gram',
            'code' => 'G',
            'symbol' => 'g',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 0.001,
            'base_uom_id' => $kilogram->id,
        ]);

        Uom::create([
            'name' => 'Milligram',
            'code' => 'MG',
            'symbol' => 'mg',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 0.000001,
            'base_uom_id' => $kilogram->id,
        ]);

        Uom::create([
            'name' => 'Ton',
            'code' => 'T',
            'symbol' => 't',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 1000,
            'base_uom_id' => $kilogram->id,
        ]);

        Uom::create([
            'name' => 'Pound',
            'code' => 'LBS',
            'symbol' => 'lbs',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 0.453592,
            'base_uom_id' => $kilogram->id,
        ]);

        Uom::create([
            'name' => 'Ounce',
            'code' => 'OZ',
            'symbol' => 'oz',
            'uom_type_id' => $weightType->id,
            'conversion_factor' => 0.0283495,
            'base_uom_id' => $kilogram->id,
        ]);

        $liter = Uom::create([
            'name' => 'Liter',
            'code' => 'L',
            'symbol' => 'L',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Milliliter',
            'code' => 'ML',
            'symbol' => 'mL',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 0.001,
            'base_uom_id' => $liter->id,
        ]);

        Uom::create([
            'name' => 'Cubic Meter',
            'code' => 'M3',
            'symbol' => 'm3',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 1000,
            'base_uom_id' => $liter->id,
        ]);

        Uom::create([
            'name' => 'Gallon (US)',
            'code' => 'GAL_US',
            'symbol' => 'gal',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 3.78541,
            'base_uom_id' => $liter->id,
        ]);

        Uom::create([
            'name' => 'Fluid Ounce (US)',
            'code' => 'FL_OZ_US',
            'symbol' => 'fl oz',
            'uom_type_id' => $volumeType->id,
            'conversion_factor' => 0.0295735,
            'base_uom_id' => $liter->id,
        ]);

        $piece = Uom::create([
            'name' => 'Piece',
            'code' => 'PCS',
            'symbol' => 'pcs',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Dozen',
            'code' => 'DOZ',
            'symbol' => 'doz',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 12,
            'base_uom_id' => $piece->id,
        ]);

        Uom::create([
            'name' => 'Gross',
            'code' => 'GRO',
            'symbol' => 'gro',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 144,
            'base_uom_id' => $piece->id,
        ]);

        Uom::create([
            'name' => 'Box',
            'code' => 'BOX',
            'symbol' => 'box',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 1,
        ]);

        Uom::create([
            'name' => 'Pack',
            'code' => 'PACK',
            'symbol' => 'pack',
            'uom_type_id' => $quantityType->id,
            'conversion_factor' => 1,
        ]);
    }
}
