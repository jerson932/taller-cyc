<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    public function run(): void
    {
       DB::table('clientes')->insert([
    [
        'nombre' => 'Juan Pérez',
        'telefono' => '123456789',
        'email' => 'juan@example.com',
    ],
    [
        'nombre' => 'María Gómez',
        'telefono' => '987654321',
        'email' => 'maria@example.com',
    ],
        ]);
    }
}
