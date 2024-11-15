<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            [
                'nombre' => 'Gerente',
                'descripcion' => 'Responsable de la gestión general de la empresa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Analista',
                'descripcion' => 'Encargado del análisis de datos y reportes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Desarrollador',
                'descripcion' => 'Encargado del desarrollo de software',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

?>