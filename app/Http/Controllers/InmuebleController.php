<?php

namespace App\Http\Controllers;

use App\Models\Inmueble;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class InmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $inmueble = Inmueble::all();
        
        $resultResponse = new ResultResponse();

        $resultResponse->setData($inmueble);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);

    }


    public function getInmuebles(Request $request)
    {
        
        // Validar que los parámetros sean opcionales, pero por lo menos uno debe estar presente
        $validated = $request->validate([
            'id_tipo' => 'nullable|integer',
            'id_ciudad' => 'nullable|integer',
            'id_propietario' => 'nullable|integer',
            'nuevo_usado' => 'nullable|string|max:50',
            'disponibilidad' => 'nullable|string|max:2',
            'compra_arriendo' => 'nullable|string|max:50',    
            'area_m2' => 'nullable|integer',
            'num_banios' => 'nullable|integer',
            'num_habitaciones' => 'nullable|integer',
            'page' => 'nullable|integer',         // Añadir validación para paginación
            'per_page' => 'nullable|integer',     // Añadir validación para número de registros por página
        ]);

        // Comprobar que al menos uno de los parámetros esté presente
        if ($request->hasAny(['id_tipo', 'id_ciudad', 'id_propietario' ,'nuevo_usado', 'compra_arriendo','disponibilidad','area_m2','num_banios','num_habitaciones'])) {

           // Construir la consulta dinámicamente
            $query = Inmueble::query();

            if ($request->filled('id_tipo')) {
                $query->where('id_tipo', $request->id_tipo);
            };

            if ($request->filled('id_ciudad')) {
                $query->where('id_ciudad', $request->id_ciudad);
            };

            if ($request->filled('id_propietario')) {
                $query->where('id_propietario', $request->id_propietario);
            };

            if ($request->filled('nuevo_usado')) {
                $query->where('nuevo_usado', $request->nuevo_usado);
            };

            if ($request->filled('compra_arriendo')) {
                $query->where('compra_arriendo', $request->compra_arriendo);
            }; 

            if ($request->filled('disponibilidad')) {
                $query->where('disponibilidad', $request->disponibilidad);
            };

            if ($request->filled('area_m2')) {
                $query->where('area_m2', $request->area_m2);
            };

            if ($request->filled('num_banios')) {
                $query->where('num_banios', $request->num_banios);
            };

            if ($request->filled('num_habitaciones')) {
                $query->where('num_habitaciones', $request->num_habitaciones);
            };

            //$inmueble = Inmueble::all();
            // Ejecutar la consulta y obtener los resultados
            // Obtener los parámetros de paginación, por defecto 15 registros por página si no se envían
            $perPage = $request->get('per_page', 15); // Por defecto 15 registros por página
            $inmueble = $query->paginate($perPage);  // Usar paginate() en lugar de get()               
            //$inmueble = $query->get();
            $resultResponse = new ResultResponse();    
            $resultResponse->setData($inmueble->items());  // Pasar solo los elementos de la página actual
            $resultResponse->setCurrent_page($inmueble->currentPage());  // Pasar solo los elementos de la página actual
            $resultResponse->setTotal_pages($inmueble->lastPage());  // Pasar solo los elementos de la página actual            
            $resultResponse->setTotal_items($inmueble->total());  // Total de registros  
            $resultResponse->setPer_page($inmueble->perPage());  // Registros por página  
            $resultResponse->setNext_page_url($inmueble->nextPageUrl());  // URL de la próxima página  
            $resultResponse->setPrev_page_url($inmueble->previousPageUrl());  // URL de la página anterior       
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        }
        // Comprobar que al menos uno de los parámetros esté presente
        else{
            $inmueble = Inmueble::all();
            $resultResponse = new ResultResponse();    
            $resultResponse->setData($inmueble);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        };

        return response()->json($resultResponse);

    }
    


    // registros en al basura
    public function trashed()
    {
        
        $inmueble = Inmueble::onlyTrashed();        
        $resultResponse = new ResultResponse();
        $resultResponse->setData($inmueble);
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
        $this->validateInmueble($request);

        $resultResponse= new ResultResponse();
        try{
            $newInmueble = new Inmueble([
                'id_propietario'=> $request->get('id_propietario'),
                'descripcion'=>  $request->get('descripcion'),
                'area_m2'=> $request->get('area_m2'),
                'num_banios'=>  $request->get('num_banios'),
                'num_habitaciones'=>  $request->get('num_habitaciones'),
                'observaciones'=> $request->get('observaciones'),
                'direccion'=> $request->get('direccion'),
                'imagen'=>  $request->get('imagen'),
                'disponibilidad'=> $request->get('disponibilidad'),
                'amueblado'=>  $request->get('amueblado'),
                'nuevo_usado'=> $request->get('nuevo_usado'),
                'compra_arriendo'=>  $request->get('compra_arriendo'),
                'valor'=>  $request->get('valor'),
                'id_tipo'=> $request->get('id_tipo'),
                'id_ciudad'=>  $request->get('id_ciudad')

            ]);

            $newInmueble->save();

            $resultResponse->setData($newInmueble);
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
            $inmueble = Inmueble::findOrFail($id);

            $resultResponse->setData($inmueble);
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
    public function edit(Inmueble $inmueble)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     // modificaicon completa 

    public function update(Request $request, $id)
    {
        $this->validateInmueble($request);
        $resultResponse =  new ResultResponse();

        try{

            $inmueble = Inmueble::findOrfail($id);

            $inmueble->id_propietario =  $request->get('id_propietario');
            $inmueble->descripcion =  $request->get('descripcion');
            $inmueble->area_m2 =  $request->get('area_m2');
            $inmueble->num_banios =  $request->get('num_banios');
            $inmueble->num_habitaciones =  $request->get('num_habitaciones');
            $inmueble->observaciones =  $request->get('observaciones');
            $inmueble->direccion =  $request->get('direccion');
            $inmueble->imagen =  $request->get('imagen');
            $inmueble->disponibilidad =  $request->get('disponibilidad');
            $inmueble->amueblado =  $request->get('amueblado');
            $inmueble->nuevo_usado =  $request->get('nuevo_usado');
            $inmueble->compra_arriendo =  $request->get('compra_arriendo');
            $inmueble->valor =  $request->get('valor');
            $inmueble->id_tipo =  $request->get('id_tipo');
            $inmueble->id_ciudad =  $request->get('id_ciudad');

            $inmueble->save();

            $resultResponse->setData($inmueble);
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

            $inmueble = Inmueble::findOrfail($id);

            $inmueble->id_propietario =  $request->get('id_propietario',$inmueble->id_propietario);
            $inmueble->descripcion =  $request->get('descripcion', $inmueble->descripcion );
            $inmueble->area_m2 =  $request->get('area_m2', $inmueble->area_m2);
            $inmueble->num_banios =  $request->get('num_banios',$inmueble->num_banios);
            $inmueble->num_habitaciones =  $request->get('num_habitaciones',$inmueble->num_habitaciones);
            $inmueble->observaciones =  $request->get('observaciones',$inmueble->observaciones);
            $inmueble->direccion =  $request->get('direccion',$inmueble->direccion);
            $inmueble->imagen =  $request->get('imagen',$inmueble->imagen);
            $inmueble->disponibilidad =  $request->get('disponibilidad',$inmueble->disponibilidad);
            $inmueble->amueblado =  $request->get('amueblado',$inmueble->amueblado);
            $inmueble->nuevo_usado =  $request->get('nuevo_usado',$inmueble->nuevo_usado);
            $inmueble->compra_arriendo =  $request->get('compra_arriendo',$inmueble->compra_arriendo);
            $inmueble->valor =  $request->get('valor',$inmueble->valor);
            $inmueble->id_tipo =  $request->get('id_tipo', $inmueble->id_tipo);
            $inmueble->id_ciudad =  $request->get('id_ciudad',$inmueble->id_ciudad);            

            $inmueble->save();

            $resultResponse->setData($inmueble);
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
    
    // soft delete
    public function softDelete($id)
    {
        $resultResponse =  new ResultResponse();

        try{

            $inmueble = Inmueble::findOrfail($id);
            $inmueble->delete();

            $resultResponse->setData($inmueble);
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

    // restore delete
    public function restore($id)
    {
        $resultResponse =  new ResultResponse();

        try{

            $inmueble = Inmueble::findOrfail($id);
            $inmueble->withTrashed();

            $resultResponse->setData($inmueble);
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

            $inmueble = Inmueble::findOrfail($id);
            $inmueble->delete();

            $resultResponse->setData($inmueble);
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


    public function validateInmueble($request)
    {
        $rules = [];
        $messages =[];
        $rules['id_propietario'] ='required';
        $messages['id_propietario.required'] = lang::get('alerts.inmueble_id_propietario_required');

        $rules['descripcion'] ='required';
        $messages['descripcion.required'] = lang::get('alerts.inmueble_descripcion_required');

        $rules['area_m2'] ='required|numeric|min:0';        
        $messages['area_m2.required'] = lang::get('alerts.inmueble_area_m2_required');
        $messages['area_m2.numeric'] = Lang::get('alerts.inmueble_area_m2_numeric');  
        $messages['area_m2.min'] = Lang::get('alerts.inmueble_area_m2_min');  
        
        $rules['num_banios'] ='required|numeric|min:0'; 
        $messages['num_banios.required'] = lang::get('alerts.inmueble_num_banios_required');
        $messages['num_banios.numeric'] = Lang::get('alerts.inmueble_num_banios_numeric');  
        $messages['num_banios.min'] = Lang::get('alerts.inmueble_num_banios_min');  

        $rules['num_habitaciones'] ='required';        
        $messages['num_habitaciones.required'] = lang::get('alerts.inmueble_num_habitaciones_required');
        
        $rules['direccion'] ='required';
        $messages['direccion.required'] = lang::get('alerts.inmueble_direccion_required');

        $rules['imagen'] ='required';        
        $messages['imagen.required'] = lang::get('alerts.inmueble_imagen_required');
        
        $rules['disponibilidad'] ='required';
        $messages['disponibilidad.required'] = lang::get('alerts.inmueble_disponibilidad_required');

        $rules['amueblado'] ='required';        
        $messages['amueblado.required'] = lang::get('alerts.inmueble_amueblado_required');
        
        $rules['nuevo_usado'] ='required';
        $messages['nuevo_usado.required'] = lang::get('alerts.inmueble_nuevo_usado_required');        

        $rules['compra_arriendo'] ='required';        
        $messages['compra_arriendo.required'] = lang::get('alerts.inmueble_compra_arriendo_required');
        
        $rules['valor'] ='required|numeric|min:0'; 
        $messages['valor.required'] = lang::get('alerts.inmueble_valor_required'); 
        $messages['valor.numeric'] = Lang::get('alerts.inmueble_valor_numeric');  
        $messages['valor.min'] = Lang::get('alerts.inmueble_valor_min');  

        $rules['id_tipo'] ='required';        
        $messages['id_tipo.required'] = lang::get('alerts.inmueble_id_tipo_required');
        
        $rules['id_ciudad'] ='required';
        $messages['id_ciudad.required'] = lang::get('alerts.inmueble_id_ciudad_required');         

        return Validator::make($request->all(), $rules, $messages);
    }
}


// 'quantity' => ['required', 'numeric', new GreaterThanZero],