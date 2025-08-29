<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vehiculos')->insert([
            [
                'cliente_id' => 1,
                'marca_id' => 1, // Toyota
                'modelo_id' => 1, // Corolla
                'anio' => 2020,
                'placa' => 'ABC123',
            ],
            [
                'cliente_id' => 2,
                'marca_id' => 2, // Honda
                'modelo_id' => 3, // Civic
                'anio' => 2019,
                'placa' => 'XYZ789',
            ],
        ]);
    }
}
