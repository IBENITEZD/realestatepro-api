<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $paises = Pais::all();
        
        $resultResponse = new ResultResponse();

        $resultResponse->setData($paises);
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
        $this->validatePais($request);

        $resultResponse= new ResultResponse();
        try{
            $newPais = new Pais([
                'codigo'=> $request->get('codigo'),
                'nombre'=>  $request->get('nombre')
            ]);

            $newPais->save();

            $resultResponse->setData($newPais);
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
            $pais = Pais::findOrFail($id);

            $resultResponse->setData($pais);
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
    public function edit(Pais $pais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     // modificaicon completa 

    public function update(Request $request, $id)
    {
        $this->validatePais($request);
        $resultResponse =  new ResultResponse();

        try{

            $pais = Pais::findOrfail($id);

            $pais->codigo =  $request->get('codigo');
            $pais->nombre =  $request->get('nombre');

            $pais->save();

            $resultResponse->setData($pais);
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

            $pais = Pais::findOrfail($id);

            $pais->codigo =  $request->get('codigo', $pais->codigo);
            $pais->nombre =  $request->get('nombre', $pais->nombre);

            $pais->save();

            $resultResponse->setData($pais);
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

            $pais = Pais::findOrfail($id);
            $pais->delete();

            $resultResponse->setData($pais);
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


    public function validatePais($request)
    {
        $rules = [];
        $messages =[];
        $rules['codigo'] ='required';
        $messages['codigo.required'] = lang::get('alerts.pais_codigo_required');
        $rules['nombre'] ='required';
        $messages['nombre.required'] = lang::get('alerts.pais_nombre_required');

        return Validator::make($request->all(), $rules, $messages);
    }
}
