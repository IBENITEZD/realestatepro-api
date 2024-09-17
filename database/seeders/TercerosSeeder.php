<?php

namespace Database\Seeders;

use App\Models\Tercero;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TercerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 10 registros manuales para la tabla 'terceros'
        Tercero::factory()->create([
            'doc_identidad' => '901',
            'nombre' => 'Seeder Tercero 1',
            'apellidos' => 'Lopez',
            'email'=> 'test1@pruebas.com',
            'direccion'=> 'calle 1 9089',
            'telefono_movil'=> '3009878781',
            'telefono_fijo'=> '6019876761',
            'id_ciudad'=> 1,
        ]);

        Tercero::factory()->create([
            'doc_identidad' => '902',
            'nombre' => 'Seeder Tercero 2',
            'apellidos' => 'Perez',
            'email'=> 'test2@pruebas.com',
            'direccion'=> 'calle 2 9089',
            'telefono_movil'=> '3009878782',
            'telefono_fijo'=> '6019876762',
            'id_ciudad'=> 1,
        ]);

        Tercero::factory()->create([
            'doc_identidad' => '903',
            'nombre' => 'Seeder Tercero 3',
            'apellidos' => 'Garcia',
            'email'=> 'test3@pruebas.com',
            'direccion'=> 'calle 3 9089',
            'telefono_movil'=> '3009878783',
            'telefono_fijo'=> '6019876763',
            'id_ciudad'=> 1,
        ]);

        Tercero::factory()->create([
            'doc_identidad' => '904',
            'nombre' => 'Seeder Tercero 4',
            'apellidos' => 'Rodriguez',
            'email'=> 'test4@pruebas.com',
            'direccion'=> 'calle 4 9089',
            'telefono_movil'=> '3009878784',
            'telefono_fijo'=> '6019876764',
            'id_ciudad'=> 2,
        ]);

        Tercero::factory()->create([
            'doc_identidad' => '905',
            'nombre' => 'Seeder Tercero 5',
            'apellidos' => 'Martinez',
            'email'=> 'test5@pruebas.com',
            'direccion'=> 'calle 5 9089',
            'telefono_movil'=> '3009878785',
            'telefono_fijo'=> '6019876765',
            'id_ciudad'=> 2,
        ]);

        Tercero::factory()->create([
            'doc_identidad' => '906',
            'nombre' => 'Seeder Tercero 6',
            'apellidos' => 'Hernandez',
            'email'=> 'test6@pruebas.com',
            'direccion'=> 'calle 6 9089',
            'telefono_movil'=> '3009878786',
            'telefono_fijo'=> '6019876766',
            'id_ciudad'=> 2,
        ]);

        Tercero::factory()->create([
            'doc_identidad' => '907',
            'nombre' => 'Seeder Tercero 7',
            'apellidos' => 'Ramirez',
            'email'=> 'test7@pruebas.com',
            'direccion'=> 'calle 7 9089',
            'telefono_movil'=> '3009878787',
            'telefono_fijo'=> '6019876767',
            'id_ciudad'=> 2,
        ]);

        Tercero::factory()->create([
            'doc_identidad' => '908',
            'nombre' => 'Seeder Tercero 8',
            'apellidos' => 'Torres',
            'email'=> 'test8@pruebas.com',
            'direccion'=> 'calle 8 9089',
            'telefono_movil'=> '3009878788',
            'telefono_fijo'=> '6019876768',
            'id_ciudad'=> 3,
        ]);

        Tercero::factory()->create([
            'doc_identidad' => '909',
            'nombre' => 'Seeder Tercero 9',
            'apellidos' => 'Vargas',
            'email'=> 'test9@pruebas.com',
            'direccion'=> 'calle 9 9089',
            'telefono_movil'=> '3009878789',
            'telefono_fijo'=> '6019876769',
            'id_ciudad'=> 3,
        ]);

        Tercero::factory()->create([
            'doc_identidad' => '910',
            'nombre' => 'Seeder Tercero 10',
            'apellidos' => 'Diaz',
            'email'=> 'test10@pruebas.com',
            'direccion'=> 'calle 10 9089',
            'telefono_movil'=> '3009878790',
            'telefono_fijo'=> '6019876770',
            'id_ciudad'=> 3,
        ]);
    }
}

