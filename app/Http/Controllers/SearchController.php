<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class SearchController extends Controller
{
    public function search(Request $request, $entity)
    {
        $resultResponse = new ResultResponse();

        // Verificar que el modelo exista
        $modelClass = 'App\\Models\\' . ucfirst($entity);
        if (!class_exists($modelClass)) {
            //return response()->json(['error' => 'Modelo no encontrado'], 404);
            $results  = ['error' => 'Modelo no encontrado '.$entity];
            $resultResponse->setData($results);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
            return response()->json($resultResponse);
        }

        // Obtener los campos por los cuales se puede buscar
        $query = $modelClass::query();
        
        $columns = Schema::getColumnListing((new $modelClass)->getTable());
        
        // Aplicar filtros de búsqueda dinámicos
        foreach ($request->all() as $field => $value) {
            if (in_array($field, $columns)) {
                $query->where($field, 'LIKE', '%' . $value . '%');
            }
        }
        
        // Definir el tamaño de la página, con un valor predeterminado de 10 registros por página
        $perPage = $request->input('per_page', 10);

        // Obtener los resultados
        try{
            // Obtener los resultados paginados
            $results = $query->paginate($perPage);
            $resultResponse->setData($results->items());  // Pasar solo los elementos de la página actual
            $resultResponse->setCurrent_page($results->currentPage());  // Pasar solo los elementos de la página actual
            $resultResponse->setTotal_pages($results->lastPage());  // Pasar solo los elementos de la página actual            
            $resultResponse->setTotal_items($results->total());  // Total de registros  
            $resultResponse->setPer_page($results->perPage());  // Registros por página  
            $resultResponse->setNext_page_url($results->nextPageUrl());  // URL de la próxima página  
            $resultResponse->setPrev_page_url($results->previousPageUrl());  // URL de la página anterior  
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        }
        catch(\Exception $e){            
            // Registrar el error y devolver una respuesta clara
            Log::error("Error al ejecutar la búsqueda: " . $e->getMessage());    
            $resultResponse->setData(['error' => 'Error al ejecutar la búsqueda para: ' . $entity]);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);

        }
        
        return response()->json($resultResponse);
    }
}