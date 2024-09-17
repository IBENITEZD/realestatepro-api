<?php

namespace Database\Seeders;

use App\Models\Pais;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 10 registros manuales para la tabla 'paises'
        Pais::factory()->create([
            'codigo' => 'P01',
            'nombre' => 'Seeder Pais 1',
        ]);

        Pais::factory()->create([
            'codigo' => 'P02',
            'nombre' => 'Seeder Pais 2',
        ]);

        Pais::factory()->create([
            'codigo' => 'P03',
            'nombre' => 'Seeder Pais 3',
        ]);

        Pais::factory()->create([
            'codigo' => 'P04',
            'nombre' => 'Seeder Pais 4',
        ]);

        Pais::factory()->create([
            'codigo' => 'P05',
            'nombre' => 'Seeder Pais 5',
        ]);

        Pais::factory()->create([
            'codigo' => 'P06',
            'nombre' => 'Seeder Pais 6',
        ]);

        Pais::factory()->create([
            'codigo' => 'P07',
            'nombre' => 'Seeder Pais 7',
        ]);

        Pais::factory()->create([
            'codigo' => 'P08',
            'nombre' => 'Seeder Pais 8',
        ]);

        Pais::factory()->create([
            'codigo' => 'P09',
            'nombre' => 'Seeder Pais 9',
        ]);

        Pais::factory()->create([
            'codigo' => 'P10',
            'nombre' => 'Seeder Pais 10',
        ]);
    }
}

