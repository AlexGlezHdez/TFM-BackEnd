<?php

namespace Database\Seeders;

use App\Models\Autor;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
  public function run()
  {
    Autor::factory()
      ->count(5)
      ->hasEntradas(3)
      ->create();
  }
}