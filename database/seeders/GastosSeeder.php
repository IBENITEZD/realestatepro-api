<?php

namespace Database\Seeders;

use App\Models\Gasto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;  // Importar Carbon para manejar fechas

class GastosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Fecha inicial y final para el rango
        $startDate = Carbon::createFromFormat('Y-m-d', '2024-09-09');
        $endDate = Carbon::createFromFormat('Y-m-d', '2024-12-31');

        //
        for ($i = 1; $i <= 200; $i++) {
            Gasto::factory()->create([
                'id_inmueble' =>  rand(1, 10),
                'importe' => rand(500, 2000),
                'concepto' => 'seeder',
                'fecha_emision'=>Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp))->format('Y-m-d'), // Generar una fecha aleatoria,
                'observaciones'=> Str::random(rand(40, 80))
            ]);
        };

    }
}


