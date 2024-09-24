<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;



class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ciudades = Ciudad::all();
        
        $resultResponse = new ResultResponse;

        $resultResponse->setData($ciudades);
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
        $this->validateCiudad($request);

        $resultResponse= new ResultResponse();
        try{
            $newCiudad = new Ciudad([
                'codigo'=> $request->get('codigo'),
                'nombre'=>  $request->get('nombre'),
                'id_provincia'=> $request->get('id_provincia')
            ]);

            $newCiudad->save();

            $resultResponse->setData($newCiudad);
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
            $provincia = Ciudad::findOrFail($id);

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
    public function edit(Ciudad $provincia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ciudad $provincia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ciudad $provincia)
    {
        //
    }

    public function validateCiudad($request)
    {
        $rules = [];
        $messages =[];
        $rules['codigo'] ='required';
        $messages['codigo.required'] = lang::get('alerts.provincia_codigo_required');
        $rules['nombre'] ='required';
        $messages['nombre.required'] = lang::get('alerts.provincia_nombre_required');
        $rules['id_provincia'] ='required';
        $messages['id_provincia.required'] = lang::get('alerts.provincia_id_provincia_required');

        return Validator::make($request->all(), $rules, $messages);
    }
}