<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store($reservation){

        /* $reservation->validate([
            'arrivalDay'=>'required',
            'deapertureDay'=>'required',
            'taxes'=>'required|numeric',
            'subtotal'=>'required|numeric',
            'total'=>'required|numeric',
            'house_id'=>'required|numeric'
        ]); */

        $dateReservation = Reservation::create([
            'arrivalDay' => $reservation['arrivalDay'],
            'deapertureDay' => $reservation['deapertureDay'],
            'taxes' => $reservation['taxes'],
            'subtotal' => $reservation['subtotal'],
            'total' => $reservation['total'],
            'house_id' => $reservation['house_id']
        ]);

        return response()->json([
            'message' => 'reservation correctly'
        ]);
    }
}
