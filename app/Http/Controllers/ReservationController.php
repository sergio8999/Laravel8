<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function store(Request $reservation){
           
        Reservation::set($reservation['arrivalDay'], $reservation['departureDay'], $reservation['arrivalTime'], $reservation['departureTime'], $reservation['taxes'], $reservation['subtotal'],$reservation['total'],$reservation['user_id'], $reservation['house_id']);
        
        return response()->json([
            'message' => 'reservation correctly'
        ]);
    }

    public function show(Request $id){
        $reservation =  Reservation::where('reservations.user_id',$id['user_id'])->get();
        return $reservation;
    }

}
