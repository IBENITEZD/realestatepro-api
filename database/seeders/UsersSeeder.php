<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // administrador
        User::factory()->create([
            'name' => 'Propietario con inmuebles',
            'email' => 'test1@prueba.com',
            'password'=>  Hash::make('1234'),
            'espropietario'  => 1,
        ]);

        // administrador
        User::factory()->create([
            'name' => 'Propietario sin inmuebles',
            'email' => 'abcd@abcd.com',
            'password'=>  Hash::make('1234'),
            'espropietario'  => 1,
        ]);

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@realstate.com',
            'password'=>'12345',
            'espropietario'  => 0,
        ]);
        
    }
}
