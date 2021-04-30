<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{


    public function sigUp(Request $request){
        
        $request->validate([
            'name' => 'required|string|unique:administradors',
            'password' => 'required|string'
        ]);

        try{
            Administrador::set($request['name'],$request['password']);

            return response()->json([
                'message' => 'Successfully created administrador!'
            ], 201);
        }catch(Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function login(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        try{
            $administrador = Administrador::where('name', $request['name'])->first();

            if($administrador && Hash::check($request['password'], $administrador['password']))
                return response()->json([
                    'message'=>'Logueado correctamente',
                    'status'=>true
                ]);
            else {
                return response()->json([
                    'message'=>'Error al loguearse',
                    'status'=>false
                ]);
            }
        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }
    }
}
