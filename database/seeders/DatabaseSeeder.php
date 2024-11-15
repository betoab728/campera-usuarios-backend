<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamar a cada seeder en el orden correcto
        $this->call([
            RolesTableSeeder::class,
            PositionsTableSeeder::class,
            EmployeesTableSeeder::class,
            UsersTableSeeder::class,
        ]);
    }
}
