<?php

namespace Database\Seeders;

use App\Models\Ciudad;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 10 registros manuales para la tabla 'ciudades'
        Ciudad::factory()->create([
            'codigo' => '00001',
            'nombre' => 'Seeder Ciudad 1',
            'id_provincia' => 1,
        ]);

        Ciudad::factory()->create([
            'codigo' => '00002',
            'nombre' => 'Seeder Ciudad 2',
            'id_provincia' => 1,
        ]);

        Ciudad::factory()->create([
            'codigo' => '00003',
            'nombre' => 'Seeder Ciudad 3',
            'id_provincia' => 2,
        ]);

        Ciudad::factory()->create([
            'codigo' => '00004',
            'nombre' => 'Seeder Ciudad 4',
            'id_provincia' => 2,
        ]);

        Ciudad::factory()->create([
            'codigo' => '00005',
            'nombre' => 'Seeder Ciudad 5',
            'id_provincia' => 3,
        ]);

        Ciudad::factory()->create([
            'codigo' => '00006',
            'nombre' => 'Seeder Ciudad 6',
            'id_provincia' => 3,
        ]);

        Ciudad::factory()->create([
            'codigo' => '00007',
            'nombre' => 'Seeder Ciudad 7',
            'id_provincia' => 4,
        ]);

        Ciudad::factory()->create([
            'codigo' => '00008',
            'nombre' => 'Seeder Ciudad 8',
            'id_provincia' => 4,
        ]);

        Ciudad::factory()->create([
            'codigo' => '00009',
            'nombre' => 'Seeder Ciudad 9',
            'id_provincia' => 5,
        ]);

        Ciudad::factory()->create([
            'codigo' => '00010',
            'nombre' => 'Seeder Ciudad 10',
            'id_provincia' => 5,
        ]);
    }
}
