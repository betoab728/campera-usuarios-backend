<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nombre' => 'Admin',
                'descripcion' => 'Administrador del sistema',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'User',
                'descripcion' => 'Usuario regular',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Manager',
                'descripcion' => 'Gerente de área',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
?>
