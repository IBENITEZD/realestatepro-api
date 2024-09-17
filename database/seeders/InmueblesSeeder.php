<?php

namespace Database\Seeders;

use App\Models\Inmueble;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class InmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generar 100 registros de inmuebles
        for ($i = 1; $i <= 100; $i++) {
            Inmueble::factory()->create([
                'id_propietario' => rand(1, 5),
                'descripcion' => 'Seeder '. rand(1, 10) .' propiedad en Venta en Colinas de San Luis, Medellín',
                'area_m2' => rand(51, 149), // Área entre 50 y 150 m²
                'num_banios' => rand(0, 3), // Número de baños entre 0 y 3
                'num_habitaciones' => rand(0, 10), // Número de habitaciones entre 0 y 10
                'observaciones' => Str::random(rand(40, 80)), // Observaciones aleatorias de entre 40 y 80 caracteres,
                'direccion' => 'calle ' . rand(1, 100) . ' 9089', // Dirección variada
                'imagen' => 'https://doxasistemas.com/realestatepro/files/' . rand(1, 10) . '.jpg', // Imágenes de 1.jpg a 10.jpg
                'disponibilidad' => rand(0, 1) ? 'Si' : 'No', // Disponibilidad solo "Si" o "No"
                'amueblado' => rand(0, 1), // Amueblado: 0 o 1
                'nuevo_usado' => rand(0, 1) ? 'Nuevo' : 'Usado', // Estado: "Nuevo" o "Usado"
                'compra_arriendo' => rand(0, 1) ? 'Compra' : 'Arriendo', // Compra o arriendo
                'valor' => rand(500, 1500), // Valor entre 500 y 1500 (puedes ajustar esto)
                'id_tipo' => rand(1, 5), // id_tipo entre 1 y 5
                'id_ciudad' => rand(1, 2) // id_ciudad entre 1 y 5
            ]);
        }
    }
}



