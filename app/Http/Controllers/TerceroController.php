<?php

namespace App\Http\Controllers;

use App\Models\Tercero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class TerceroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $terceros = Tercero::all();
        
        $resultResponse = new ResultResponse();

        $resultResponse->setData($terceros);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $this->validateTercero($request);

        $resultResponse= new ResultResponse();

        // Validar si ya existe un tercero con el mismo email o doc_identidad
        $existingTerceroByEmail = Tercero::where('email', $request->get('email'))->first();
        $existingTerceroByDocIdentidad = Tercero::where('doc_identidad', $request->get('doc_identidad'))->first();

        // Verificar si ya existe un tercero con el mismo email
        if ($existingTerceroByEmail) {
            $resultResponse->setData(['error' => 'Ya existe un tercero con este email: ' . $request->get('email')]);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage('El email ya está en uso.');
            return response()->json($resultResponse);
        }

        // Verificar si ya existe un tercero con el mismo documento de identidad
        if ($existingTerceroByDocIdentidad) {
            $resultResponse->setData(['error' => 'Ya existe un tercero con este documento de identidad: ' . $request->get('doc_identidad')]);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage('El documento de identidad ya está en uso.');
            return response()->json($resultResponse);
        }
            
        try{
            $newTercero = new Tercero([
                'doc_identidad'=> $request->get('doc_identidad'),
                'nombre'=>  $request->get('nombre'),
                'apellidos'=> $request->get('apellidos'),
                'email'=>  $request->get('email'),
                'direccion'=> $request->get('direccion'),
                'telefono_movil'=>  $request->get('telefono_movil'),
                'telefono_fijo'=> $request->get('telefono_fijo'),
                'id_ciudad'=>  $request->get('id_ciudad')
            ]);


            $newTercero->save();

            $resultResponse->setData($newTercero);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            
        }catch(\Exception $e){
            Log::debug($e);
            $resultResponse->setData($e);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        
        return response()->json($resultResponse);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resultResponse= new ResultResponse();
        
        try{
            $tercero = Tercero::findOrFail($id);

            $resultResponse->setData($tercero);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            
        }catch(\Exception $e){
            Log::debug($e);
            $resultResponse->setData($e);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        
        return response()->json($resultResponse);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tercero $tercero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     // modificaicon completa 

    public function update(Request $request, $id)
    {
        $this->validateTercero($request);
        $resultResponse =  new ResultResponse();

        try{

            $tercero = Tercero::findOrfail($id);

            $tercero->doc_identidad =  $request->get('doc_identidad');
            $tercero->nombre =  $request->get('nombre');            
            $tercero->apellidos =  $request->get('apellidos');
            $tercero->email =  $request->get('email');
            $tercero->direccion =  $request->get('direccion');
            $tercero->telefono_movil =  $request->get('telefono_movil');
            $tercero->telefono_fijo =  $request->get('telefono_fijo');
            $tercero->id_ciudad =  $request->get('id_ciudad');            

            $tercero->save();

            $resultResponse->setData($tercero);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            
        }catch(\Exception $e){
            Log::debug($e);
            $resultResponse->setData($e);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        
        return response()->json($resultResponse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function put(Request $request, $id)
    {
        $resultResponse =  new ResultResponse();

        try{

            $tercero = Tercero::findOrfail($id);

            $tercero->doc_identidad =  $request->get('doc_identidad', $tercero->doc_identidad);
            $tercero->nombre =  $request->get('nombre', $tercero->nombre);            
            $tercero->apellidos =  $request->get('apellidos', $tercero->apellidos);
            $tercero->email =  $request->get('email', $tercero->email);
            $tercero->direccion =  $request->get('direccion', $tercero->direccion);
            $tercero->telefono_movil =  $request->get('telefono_movil', $tercero->telefono_movil);
            $tercero->telefono_fijo =  $request->get('telefono_fijo', $tercero->telefono_fijo);
            $tercero->id_ciudad =  $request->get('id_ciudad', $tercero->id_ciudad);
            $tercero->save();

            $resultResponse->setData($tercero);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            
        }catch(\Exception $e){
            Log::debug($e);
            $resultResponse->setData($e);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        
        return response()->json($resultResponse);
    }
    
    // delete el pais 

    public function destroy($id)
    {
        $resultResponse =  new ResultResponse();

        try{

            $tercero = Tercero::findOrfail($id);
            $tercero->delete();

            $resultResponse->setData($tercero);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            
        }catch(\Exception $e){
            Log::debug($e);
            $resultResponse->setData($e);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        
        return response()->json($resultResponse);
    }


    public function validateTercero($request)
    {
        $rules = [];
        $messages =[];
        $rules['doc_identidad'] ='required';
        $messages['doc_identidad.required'] = lang::get('alerts.tercero_doc_identidad_required');
        $rules['nombre'] ='required';
        $messages['nombre.required'] = lang::get('alerts.tercero_nombre_required');
        $rules['apellidos'] ='required';
        $messages['apellidos.required'] = lang::get('alerts.tercero_apellidos_required');
        $rules['email'] ='required';
        $messages['email.required'] = lang::get('alerts.tercero_email_required');
        $rules['direccion'] ='required';
        $messages['direccion.required'] = lang::get('alerts.tercero_direccion_required');
        $rules['telefono_movil'] ='required';
        $messages['telefono_movil.required'] = lang::get('alerts.tercero_telefono_movil_required'); 
        $rules['id_ciudad'] ='required';
        $messages['id_ciudad.required'] = lang::get('alerts.tercero_id_ciudad_required');        
        return Validator::make($request->all(), $rules, $messages);
    }
}
