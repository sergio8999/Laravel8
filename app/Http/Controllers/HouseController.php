<?php

namespace App\Http\Controllers;

use App\Models\House;
use Exception;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function houses(){
        $houses = House::orderBy('id','desc')->get();

        return $houses;
    }

    public function show($id){ 
        try{
            $house = House::where('id',$id)
            ->with('details')
            ->get();
            return response()->json([
                'house'=> $house
            ]);
        }catch(Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage()
            ]);
        }
    }
}
