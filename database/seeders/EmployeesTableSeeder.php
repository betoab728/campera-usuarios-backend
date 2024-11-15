<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'nombre' => 'Juan',
                'apellidoPaterno' => 'Pérez',
                'apellidoMaterno' => 'González',
                'dni' => '12345678',
                'fechaNacimiento' => '1990-01-01',
                'direccion' => 'Av. Ejemplo 123',
                'correo' => 'juan.perez@example.com',
                'telefono' => '987654321',
                'fechaIngreso' => '2022-01-01',
                'fechaCese' => null,
                'idCargo' => 1, // Asegúrate de que el cargo con ID 1 exista en la tabla positions
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María',
                'apellidoPaterno' => 'López',
                'apellidoMaterno' => 'Fernández',
                'dni' => '87654321',
                'fechaNacimiento' => '1985-05-15',
                'direccion' => 'Calle Ejemplo 456',
                'correo' => 'maria.lopez@example.com',
                'telefono' => '912345678',
                'fechaIngreso' => '2021-06-01',
                'fechaCese' => null,
                'idCargo' => 2, // Asegúrate de que el cargo con ID 2 exista en la tabla positions
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
?>