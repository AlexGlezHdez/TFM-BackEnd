<?php

namespace Database\Seeders;

use App\Models\CentroBuceo;
use Illuminate\Database\Seeder;

class CentroBuceoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CentroBuceo::factory()->count(20)->create();
    }
}
