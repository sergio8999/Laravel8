<?php

namespace App\Http\Controllers;

use App\Models\House;
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
