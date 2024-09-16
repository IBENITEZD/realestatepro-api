<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\TerceroController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ReciboController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::controller(PaisController::class)->prefix('paises')->group(function () {
    Route::get('/', 'index');         // Listar todos los países
    Route::post('/', 'store');        // Crear un nuevo país
    Route::post('/{id}', 'update');    // Actualizar un país existente
    Route::put('/{id}', 'put');    // Actualizar un país existente campos especificos
    Route::get('/{id}', 'show');      // Obtener un país por su ID
    Route::delete('/{id}', 'destroy'); // Eliminar un país

});

Route::controller(ProvinciaController::class)->prefix('provincias')->group(function () {
    Route::get('/', 'index');         // Listar todos los provincias
    Route::post('/', 'store');        // Crear un nuevo provincias
    Route::post('/{id}', 'update');    // Actualizar un provincias existente
    Route::put('/{id}', 'put');    // Actualizar un provincias existente campos especificos
    Route::get('/{id}', 'show');      // Obtener un provincias por su ID
    Route::delete('/{id}', 'destroy'); // Eliminar un provincias

});

Route::controller(InmuebleController::class)->prefix('inmuebles')->group(function () {
    Route::get('/', 'index');         // Listar todos los inmuebles
    Route::post('/', 'store');        // Crear un nuevo inmuebles
    Route::post('/{id}', 'update');    // Actualizar un inmuebles existente
    Route::put('/{id}', 'put');    // Actualizar un inmuebles existente campos especificos
    Route::get('/{id}', 'show');      // Obtener un inmuebles por su ID
    Route::delete('/{id}', 'destroy'); // Eliminar un inmuebles

});


Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/', 'index');        
    Route::post('/', 'store');        
    Route::post('/{id}', 'update');    
    Route::put('/{id}', 'put');    
    Route::get('/{id}', 'show');    
    Route::delete('/{id}', 'destroy'); 
});

Route::controller(TerceroController::class)->prefix('terceros')->group(function () {
    Route::get('/', 'index');      
    Route::post('/', 'store');       
    Route::post('/{id}', 'update');   
    Route::put('/{id}', 'put');   
    Route::get('/{id}', 'show');  
    Route::delete('/{id}', 'destroy'); 

});

Route::controller(GastoController::class)->prefix('gastos')->group(function () {
    Route::get('/', 'index');         // Listar todos los inmuebles
    Route::post('/', 'store');        // Crear un nuevo inmuebles
    Route::post('/{id}', 'update');    // Actualizar un inmuebles existente
    Route::put('/{id}', 'put');    // Actualizar un inmuebles existente campos especificos
    Route::get('/{id}', 'show');      // Obtener un inmuebles por su ID
    Route::delete('/{id}', 'destroy'); // Eliminar un inmuebles

});

Route::controller(ReciboController::class)->prefix('recibos')->group(function () {
    Route::get('/', 'index');         // Listar todos los inmuebles
    Route::post('/', 'store');        // Crear un nuevo inmuebles
    Route::post('/{id}', 'update');    // Actualizar un inmuebles existente
    Route::put('/{id}', 'put');    // Actualizar un inmuebles existente campos especificos
    Route::get('/{id}', 'show');      // Obtener un inmuebles por su ID
    Route::delete('/{id}', 'destroy'); // Eliminar un inmuebles

});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();



