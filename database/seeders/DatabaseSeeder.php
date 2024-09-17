<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Tipo;
use App\Models\Inmuebles;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User Seeder 6',
            'email' => 'testSeeder6@example.com'
        ]);       

        //Llamar al seeder de la tabla 
       $this->call(PaisesSeeder::class);

       //Llamar al seeder de la tabla 
       $this->call(ProvinciasSeeder::class);

        //Llamar al seeder de la tabla 
        $this->call(CiudadesSeeder::class);

        //Llamar al seeder de la tabla 
        $this->call(TercerosSeeder::class);

        //Llamar al seeder de la tabla 
        $this->call(TiposSeeder::class);

        //Llamar al seeder de la tabla 
        $this->call(InmueblesSeeder::class);

        //Llamar al seeder de la tabla 
        $this->call(GastosSeeder::class);

        //Llamar al seeder de la tabla 
        $this->call(RecibosSeeder::class);

        //Llamar al seeder de la tabla 
        $this->call(Inmueble_archivosSeeder::class);

    }
}

