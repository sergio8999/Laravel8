<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Reservation;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function houses(){
        $houses = House::orderBy('id','desc')->get();

        return $houses;
    }

    public function show($id){ 
       $house = House::find($id);
        
       return $house;
    }
}
