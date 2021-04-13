<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{

    public function allReservationHouse(Request $id){
        try{
            $reservation = Reservation::where('house_id',$id['house_id'])->get();
            return response()->json([
                'reservation'=> $reservation
            ]);
        }catch(Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage()
            ]);
        } 
    }


    public function store(Request $reservation){
           
        Reservation::set($reservation['arrivalDay'], $reservation['departureDay'], $reservation['arrivalTime'], $reservation['departureTime'], $reservation['taxes'], $reservation['subtotal'],$reservation['total'],$reservation['user_id'], $reservation['house_id']);
        
        return response()->json([
            'message' => 'reservation correctly'
        ]);
    }

    public function show(Request $id){
        try{
            $reservation =  Reservation::where('user_id',$id['user_id'])
        ->with('house')
        ->get();
        return response()->json([
                'reservation'=> $reservation
            ]);
        }catch(Exception $exception){
            return response()->json([
                    'message'=> $exception->getMessage()
            ]);
        }
    }
}
