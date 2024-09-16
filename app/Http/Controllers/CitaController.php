<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $citas = Cita::all();
        
        $resultResponse = new ResultResponse();

        $resultResponse->setData($citas);
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
        $this->validateCita($request);

        $resultResponse= new ResultResponse();
        try{
            $newCita = new Cita([
                'id_inmueble'=> $request->get('id_inmueble'),
                'nombre'=>  $request->get('nombre'),
                'email'=> $request->get('email'),
                'fecha_hora'=>  $request->get('fecha_hora'),
                'observaciones'=>  $request->get('observaciones')
            ]);


            $newCita->save();

            $resultResponse->setData($newCita);
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
        $resultResponse= new ResultResponse;
        
        try{
            $cita = Cita::findOrFail($id);

            $resultResponse->setData($cita);
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
    public function edit(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     // modificaicon completa 

    public function update(Request $request, $id)
    {
        $this->validateCita($request);
        $resultResponse =  new ResultResponse();

        try{

            $cita = Cita::findOrfail($id);

            $cita->id_inmueble =  $request->get('id_inmueble');
            $cita->nombre =  $request->get('nombre');
            $cita->email =  $request->get('email');
            $cita->fecha_hora =  $request->get('fecha_hora');
            $cita->observaciones =  $request->get('observaciones');

            $cita->save();

            $resultResponse->setData($cita);
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

            $cita = Cita::findOrfail($id);

            $cita->id_inmueble =  $request->get('id_inmueble',$cita->id_inmueble);
            $cita->nombre =  $request->get('nombre',$cita->nombre);
            $cita->email =  $request->get('email', $cita->email);
            $cita->fecha_hora =  $request->get('fecha_hora', $cita->fecha_hora);
            $cita->observaciones =  $request->get('observaciones', $cita->observaciones);
            $cita->save();

            $resultResponse->setData($cita);
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
    
    // delete el gasto 

    public function destroy($id)
    {
        $resultResponse =  new ResultResponse();

        try{

            $cita = Cita::findOrfail($id);
            $cita->delete();

            $resultResponse->setData($cita);
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


    public function validateCita($request)
    {
        $rules = [];
        $messages =[];
        $rules['id_inmueble'] ='required';
        $messages['id_inmueble.required'] = lang::get('alerts.cita_id_inmueble_required');

        $rules['nombre'] ='required';
        $messages['nombre.required'] = lang::get('alerts.cita_name_required');

        $rules['email'] ='required';
        $messages['email.required'] = lang::get('alerts.cita_email_required');
        
        $rules['fecha_hora'] ='required';
        $messages['fecha_hora.required'] = lang::get('alerts.cita_fecha_hora_required');

        return Validator::make($request->all(), $rules, $messages);
    }
}
