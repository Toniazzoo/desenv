<?php

namespace Database\Seeders;

use App\Models\CategoriaFormacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaFormacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoriaFormacao::factory()->count(3)->create();
    }
}
