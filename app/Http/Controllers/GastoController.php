<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $gastos = Gasto::all();
        
        $resultResponse = new ResultResponse();

        $resultResponse->setData($gastos);
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
        $this->validateGasto($request);

        $resultResponse= new ResultResponse();
        try{
            $newGasto = new Gasto([
                'id_inmueble'=> $request->get('id_inmueble'),
                'importe'=>  $request->get('importe'),
                'concepto'=> $request->get('concepto'),
                'fecha_emision'=>  $request->get('fecha_emision'),
                'observaciones'=>  $request->get('observaciones')
            ]);

            $newGasto->save();

            $resultResponse->setData($newGasto);
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
            $gasto = Gasto::findOrFail($id);

            $resultResponse->setData($gasto);
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
    public function edit(Gasto $gasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     // modificaicon completa 

    public function update(Request $request, $id)
    {
        $this->validateGasto($request);
        $resultResponse =  new ResultResponse();

        try{

            $gasto = Gasto::findOrfail($id);

            $gasto->id_inmueble =  $request->get('id_inmueble');
            $gasto->importe =  $request->get('importe');
            $gasto->concepto =  $request->get('concepto');
            $gasto->fecha_emision =  $request->get('fecha_emision');
            $gasto->observaciones =  $request->get('observaciones');

            $gasto->save();

            $resultResponse->setData($gasto);
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

            $gasto = Gasto::findOrfail($id);

            $gasto->id_inmueble =  $request->get('id_inmueble',$gasto->id_inmueble);
            $gasto->importe =  $request->get('importe',$gasto->importe);
            $gasto->concepto =  $request->get('concepto', $gasto->concepto);
            $gasto->fecha_emision =  $request->get('fecha_emision', $gasto->fecha_emision);
            $gasto->observaciones =  $request->get('observaciones', $gasto->observaciones);

            $gasto->save();

            $resultResponse->setData($gasto);
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

            $gasto = Gasto::findOrfail($id);
            $gasto->delete();

            $resultResponse->setData($gasto);
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


    public function validateGasto($request)
    {
        $rules = [];
        $messages =[];
        $rules['id_inmueble'] ='required';
        $messages['id_inmueble.required'] = lang::get('alerts.gasto_id_inmueble_required');

        $rules['importe'] ='required';
        $messages['importe.required'] = lang::get('alerts.gasto_importe_required');
        $messages['importe.numeric'] = lang::get('alerts.gasto_importe_numeric');
        $messages['importe.min'] = lang::get('alerts.gasto_importe_min');

        $rules['concepto'] ='required|numeric|min:0.01';
        $messages['concepto.required'] = lang::get('alerts.gasto_concepto_required');
        $rules['fecha_emision'] ='required';
        $messages['fecha_emision.required'] = lang::get('alerts.gasto_fecha_emision_required');

        return Validator::make($request->all(), $rules, $messages);
    }
}
