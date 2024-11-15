<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Asegúrate de usar una contraseña encriptada
                'status' => 1,
                'idempleado' => 1, // Asegúrate de que el empleado con ID 1 exista en la tabla employees
                'idRol' => 1,      // Asegúrate de que el rol con ID 1 exista en la tabla roles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user1',
                'email' => 'user1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Usa una contraseña encriptada
                'status' => 1,
                'idEmpleado' => 2, // Asegúrate de que el empleado con ID 2 exista en la tabla employees
                'idRol' => 2,      // Asegúrate de que el rol con ID 2 exista en la tabla roles
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
?>