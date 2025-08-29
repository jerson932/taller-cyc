<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelosSeeder extends Seeder
{
    public function run(): void
    {
        // OJO: Los id de marca deben coincidir con los insertados en MarcasSeeder
        DB::table('modelos')->insert([
            ['nombre' => 'Corolla', 'marca_id' => 1], // Toyota
            ['nombre' => 'Hilux', 'marca_id' => 1],   // Toyota
            ['nombre' => 'Civic', 'marca_id' => 2],   // Honda
            ['nombre' => 'Accord', 'marca_id' => 2],  // Honda
            ['nombre' => 'Sentra', 'marca_id' => 3],  // Nissan
            ['nombre' => 'Altima', 'marca_id' => 3],  // Nissan
            ['nombre' => 'Focus', 'marca_id' => 4],   // Ford
            ['nombre' => 'Ranger', 'marca_id' => 4],  // Ford
        ]);
    }
}
