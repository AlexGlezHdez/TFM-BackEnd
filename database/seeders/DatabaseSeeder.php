<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Generamos el usuario comodín que usaremos para las pruebas como administrador
        \App\Models\User::factory(1)
            ->create([
                'email' => 'admin@molamola.com',
                'admin' => '1'
            ]);
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AutorSeeder::class);  // Genera por cada autor las noticias que correspondan
        $this->call(CentroBuceoSeeder::class);
        $this->call(CursoSeeder::class);
    }
}
