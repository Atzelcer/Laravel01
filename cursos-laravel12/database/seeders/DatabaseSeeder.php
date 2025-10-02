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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@cursos.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Usuario Normal',
            'email' => 'user@cursos.com',
            'password' => bcrypt('user123'),
            'role' => 'user'
        ]);

        $this->call([
            CursoSeeder::class, 
            PersonaSeeder::class,
            InscripcionSeeder::class
        ]);
    }
}
