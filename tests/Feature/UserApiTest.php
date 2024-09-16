<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba básica de la respuesta de la API.
     *
     * @return void
     */
    public function test_users_endpoint()
    {
        // Enviar solicitud GET al endpoint /api/users
        $response = $this->get('/api/paises');

        // Verificar que la respuesta es exitosa
        $response->assertStatus(200);

        // Verificar que la respuesta contiene datos JSON
        $response->assertJsonStructure([
            '*' => [ // Aquí puedes especificar la estructura esperada de los datos JSON
                'id',
                'codigo',
                'nombre',
            ],
        ]);
    }
}
