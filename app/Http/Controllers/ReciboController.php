<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $recibos = Recibo::all();
        
        $resultResponse = new ResultResponse();

        $resultResponse->setData($recibos);
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
        $this->validateRecibo($request);

        $resultResponse= new ResultResponse();
        try{
            $newRecibo = new Recibo([
                'id_inmueble'=> $request->get('id_inmueble'),
                'importe'=>  $request->get('importe'),
                'concepto'=> $request->get('concepto'),
                'fecha_emision'=>  $request->get('fecha_emision'),
                'via_pago'=>  $request->get('via_pago'),
                'observaciones'=>  $request->get('observaciones')
            ]);

            $newRecibo->save();

            $resultResponse->setData($newRecibo);
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
            $recibo = Recibo::findOrFail($id);

            $resultResponse->setData($recibo);
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
    public function edit(Recibo $recibo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     // modificaicon completa 

    public function update(Request $request, $id)
    {
        $this->validateRecibo($request);
        $resultResponse =  new ResultResponse();

        try{

            $recibo = Recibo::findOrfail($id);

            $recibo->id_inmueble =  $request->get('id_inmueble');
            $recibo->importe =  $request->get('importe');
            $recibo->concepto =  $request->get('concepto');
            $recibo->fecha_emision =  $request->get('fecha_emision');
            $recibo->via_pago =  $request->get('via_pago');
            $recibo->observaciones =  $request->get('observaciones');
            

            $recibo->save();

            $resultResponse->setData($recibo);
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

            $recibo = Recibo::findOrfail($id);

            $recibo->id_inmueble =  $request->get('id_inmueble',$recibo->id_inmueble);
            $recibo->importe =  $request->get('importe',$recibo->importe);
            $recibo->concepto =  $request->get('concepto', $recibo->concepto);
            $recibo->fecha_emision =  $request->get('fecha_emision', $recibo->fecha_emision);
            $recibo->via_pago =  $request->get('via_pago', $recibo->via_pago);
            $recibo->observaciones =  $request->get('observaciones', $recibo->observaciones);
            
            $recibo->save();

            $resultResponse->setData($recibo);
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

            $recibo = Recibo::findOrfail($id);
            $recibo->delete();

            $resultResponse->setData($recibo);
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


    public function validateRecibo($request)
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
        
        $rules['via_pago'] ='required';
        $messages['via_pago.required'] = lang::get('alerts.gasto_via_pago_required');
        return Validator::make($request->all(), $rules, $messages);
    }
}
