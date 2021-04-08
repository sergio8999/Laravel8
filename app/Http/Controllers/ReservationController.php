<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $reservation){
           
        Reservation::set($reservation['arrivalDay'], $reservation['departureDay'], $reservation['arrivalTime'], $reservation['departureTime'], $reservation['taxes'], $reservation['subtotal'],$reservation['total'], $reservation['house_id']);
        return response()->json([
            'message' => 'reservation correctly'
        ]);
    }
}
