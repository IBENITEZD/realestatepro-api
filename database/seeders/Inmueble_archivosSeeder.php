<?php

namespace Database\Seeders;

use App\Models\Inmueble_archivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class Inmueble_archivosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //
        for ($i = 1; $i <= 400; $i++) {
            Inmueble_archivo::factory()->create([
                'id_inmueble' =>  rand(1, 10),
                'archivo' =>'https://doxasistemas.com/realestatepro/files/' . rand(1, 20) . '.jpg', // Imágenes de 1.jpg a 10.jpg,
                'tipo' => rand(0, 1) ? 'Imaggen' : 'PDF'
            ]);
        };
    }
}
