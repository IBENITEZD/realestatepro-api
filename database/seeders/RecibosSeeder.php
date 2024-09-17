<?php

namespace Database\Seeders;

use App\Models\Recibo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;  // Importar Carbon para manejar fechas

class RecibosSeeder extends Seeder
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
            Recibo::factory()->create([
                'id_inmueble' =>  rand(1, 10),
                'importe' => rand(500, 2000),
                'concepto' => 'seeder',
                'fecha_emision'=>Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp))->format('Y-m-d'), // Generar una fecha aleatoria,
                'via_pago'=> rand(0, 1) ? 'Efectivo' : 'Consignacion',
                'observaciones'=> Str::random(rand(40, 80))
            ]);
        };

    }
}
