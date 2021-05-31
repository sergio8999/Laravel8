<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResumeOrderRequest;
use App\Mail\ContactMailable;
use App\Mail\resumeOrderMaileable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResumeOrderController extends Controller
{
    public function store(StoreResumeOrderRequest $request){

        try{
            /* $request->validate([
                'email'=>'required|email',
                'nameHouse'=>'required',
                'arrivalDay'=>'required',
                'departureDay'=>'required',
                'arrivalTime'=>'required',
                'departureTime'=>'required',
                'subtotal'=>'required',
                'taxes'=>'required',
                'totalPrices'=>'required'
            ]); */
    
            Mail::to($request['email'])->send(new resumeOrderMaileable($request->all()));

            return response()->json([
                'message'=>'Enviado correctamente'
            ]);

        }catch(Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage()
            ]);
        }
        
    }
}