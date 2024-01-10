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
                'nombre' => 'Administrador',
                'email' => 'admin@molamola.com',
                'admin' => '1'
            ]);
        // Generamos el usuario usaremos para las pruebas como usuario registrado no administrador
        \App\Models\User::factory(1)
            ->create([
                'nombre' => 'Alejandro González',
                'email' => 'miembro@molamola.com',
                'admin' => '0'
            ]);
        // Generamos el resto de usuarios
        \App\Models\User::factory(10)->create();

        $this->call(AutorSeeder::class);  // Genera por cada autor las noticias que correspondan
        $this->call(CentroBuceoSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(ActividadSeeder::class);
    }
}
