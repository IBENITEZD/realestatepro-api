<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ResultResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $users = User::all();
        
        $resultResponse = new ResultResponse();
        $resultResponse->setData($users);
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
        $this->validateUser($request);

        $resultResponse= new ResultResponse();

        $users = User::where('email', $request->email)->first();
        if (is_null($users)) {
            try{
                $newUser = new User([
                    'name'=> $request->get('name'),
                    'email'=>  $request->get('email'),
                    'password'=>  $request->get('password'),
                    'espropietario'=>  $request->get('espropietario'),
                    'doc_identidad'=>  $request->get('doc_identidad')
                ]);
                $newUser->save();
                $resultResponse->setData($newUser);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
                
            }catch(\Exception $e){
                Log::debug($e);
                $resultResponse->setData($e);
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
            }

        }else
        {
            $users = null;
            $resultResponse->setData($users);
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
            $user = User::findOrFail($id);

            $resultResponse->setData($user);
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
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     // modificaicon completa 

    public function update(Request $request, $id)
    {
        $this->validateUser($request);
        $resultResponse =  new ResultResponse();

        try
        {

            $user = User::findOrfail($id);

            $user->name =  $request->get('name');
            $user->email =  $request->get('email');
            $user->password =  $request->get('password');
            $user->espropietario =  $request->get('espropietario');
            $user->doc_identidad =  $request->get('doc_identidad');

            $user->save();

            $resultResponse->setData($user);
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

            $user = User::findOrfail($id);
            
            $user->name =  $request->get('name',$user->name);
            $user->email =  $request->get('email',$user->email);
            $user->password =  $request->get('password',$user->password);
            $user->espropietario =  $request->get('espropietario',$user->espropietario);
            $user->doc_identidad =  $request->get('doc_identidad',$user->doc_identidad);
            
            $user->save();

            $resultResponse->setData($user);
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
    
    // delete el users 

    public function destroy($id)
    {
        $resultResponse =  new ResultResponse();

        try{

            $user = User::findOrfail($id);
            $user->delete();

            $resultResponse->setData($user);
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


    public function validateUser($request)
    {
        $rules = [];
        $messages =[];
        $rules['name'] ='required';
        $messages['name.required'] = lang::get('alerts.user_name_required');
        $rules['email'] ='required';
        $messages['email.required'] = lang::get('alerts.user_email_required');
        $rules['password'] ='required';
        $messages['password.required'] = lang::get('alerts.user_password_required');

        return Validator::make($request->all(), $rules, $messages);
    }
}

