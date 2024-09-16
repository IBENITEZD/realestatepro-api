<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provincias = Provincia::all();
        
        $resultResponse = new ResultResponse;

        $resultResponse->setData($provincias);
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
        $this->validateProvincia($request);

        $resultResponse= new ResultResponse();
        try{
            $newProvincia = new Provincia([
                'codigo'=> $request->get('codigo'),
                'nombre'=>  $request->get('nombre'),
                'id_pais'=> $request->get('id_pais')
            ]);

            $newProvincia->save();

            $resultResponse->setData($newProvincia);
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
            $provincia = Provincia::findOrFail($id);

            $resultResponse->setData($provincia);
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
    public function edit(Provincia $provincia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provincia $provincia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provincia $provincia)
    {
        //
    }

    public function validateProvincia($request)
    {
        $rules = [];
        $messages =[];
        $rules['codigo'] ='required';
        $messages['codigo.required'] = lang::get('alerts.provincia_codigo_required');
        $rules['nombre'] ='required';
        $messages['nombre.required'] = lang::get('alerts.provincia_nombre_required');
        $rules['id_pais'] ='required';
        $messages['id_pais.required'] = lang::get('alerts.provincia_id_pais_required');

        return Validator::make($request->all(), $rules, $messages);
    }
}
