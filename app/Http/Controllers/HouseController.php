<?php

namespace App\Http\Controllers;

use App\Models\House;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class HouseController extends Controller
{
    public function houses(){
        $houses = House::orderBy('id','desc')
        ->with('category','details','location')
        ->get();

        return $houses;
    }

    public function show($id){ 
        try{
            $house = House::where('id',$id)
            ->with('details','images')
            ->first();

            if($house ==null)
                return response()->json([
                    'house'=> 404
                ]);

            return response()->json([
                'house'=> $house
            ]);
        }catch(Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage()
            ]);
        }
    }

    public function showHouseCategory($id){ 
        try{
            $houses = House::where('category_id',$id)
            ->with('category','details','location','images')
            ->get();

            if($houses == null )
                return response()->json([
                    'houses'=> 404
                ]);

            return response()->json([
                'houses'=> $houses
            ]);
        }catch(Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage()
            ]);
        }
    }

}
