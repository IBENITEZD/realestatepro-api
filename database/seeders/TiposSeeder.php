<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Tipo::factory()->create([
            'codigo' => '01',
            'descripcion' => 'Seeder Casa'
        ]);

        Tipo::factory()->create([
            'codigo' => '02',
            'descripcion' => 'Seeder Apartamento'
        ]);

        Tipo::factory()->create([
            'codigo' => '03',
            'descripcion' => 'Seeder Lote'
        ]);

        Tipo::factory()->create([
            'codigo' => '04',
            'descripcion' => 'Seeder Garaje'
        ]);

        Tipo::factory()->create([
            'codigo' => '05',
            'descripcion' => 'Seeder Finca'
        ]);

        Tipo::factory()->create([
            'codigo' => '06',
            'descripcion' => 'Seeder casa-lote'
        ]);
    }
}


