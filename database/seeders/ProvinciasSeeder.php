<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provincia;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 10 registros manuales para la tabla 'provincias'
        Provincia::factory()->create([
            'codigo' => 'P01',
            'nombre' => 'Seeder Provincia 1',
            'id_pais' => 1,
        ]);

        Provincia::factory()->create([
            'codigo' => 'P02',
            'nombre' => 'Seeder Provincia 2',
            'id_pais' => 1,
        ]);

        Provincia::factory()->create([
            'codigo' => 'P03',
            'nombre' => 'Seeder Provincia 3',
            'id_pais' => 2,
        ]);

        Provincia::factory()->create([
            'codigo' => 'P04',
            'nombre' => 'Seeder Provincia 4',
            'id_pais' => 2,
        ]);

        Provincia::factory()->create([
            'codigo' => 'P05',
            'nombre' => 'Seeder Provincia 5',
            'id_pais' => 3,
        ]);

        Provincia::factory()->create([
            'codigo' => 'P06',
            'nombre' => 'Seeder Provincia 6',
            'id_pais' => 3,
        ]);

        Provincia::factory()->create([
            'codigo' => 'P07',
            'nombre' => 'Seeder Provincia 7',
            'id_pais' => 4,
        ]);

        Provincia::factory()->create([
            'codigo' => 'P08',
            'nombre' => 'Seeder Provincia 8',
            'id_pais' => 4,
        ]);

        Provincia::factory()->create([
            'codigo' => 'P09',
            'nombre' => 'Seeder Provincia 9',
            'id_pais' => 5,
        ]);

        Provincia::factory()->create([
            'codigo' => 'P10',
            'nombre' => 'Seeder Provincia 10',
            'id_pais' => 5,
        ]);
    }
}
