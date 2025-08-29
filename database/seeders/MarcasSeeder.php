<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('marcas')->insert([
            ['nombre' => 'Toyota'],
            ['nombre' => 'Honda'],
            ['nombre' => 'Nissan'],
            ['nombre' => 'Ford'],
        ]);
    }
}
