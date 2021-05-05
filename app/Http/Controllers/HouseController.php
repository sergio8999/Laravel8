<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\House_Detail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:3|max:20',
            'host' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg',
            'description' => 'required',
            'guest' => 'required',
            'bedrooms' => 'required',
            'beds' => 'required',
            'toilets' => 'required',
            'carousel' => 'required',
            'pool' => 'required',
            'wifi' => 'required',
            'category_id' => 'required',
            'location_id' => 'required'
        ]);
        
           /* $images = $request->file('carousel'); */
        foreach($request['carousel'] as $key=>$value){
            Storage::putFile('public', $value->file($key));
        } 
        
        /* foreach($images as $key => $value){
            Storage::putFile('public', $value->file($key));
        } */
        
        
            /* Storage::putFile('public', $request->file('image')); */
            
        /* try{ 
            $image = $request->file('image');
            $nameImage = Carbon::now()->format('YmdHms').'.'.$image->getClientOriginalExtension();
            $destination = public_path('images');
            $request->image->move($destination,$nameImage);

            $house = House::set($request['name'], $request['host'], $request['price'], $nameImage, $request['description'],$request['category_id'],$request['location_id']);
            House_Detail::set($request['beds'],$request['wifi'],$request['guest'],$request['bedrooms'],$request['toilets'],$request['pool'],$house['id']);
            return response()->json([
                'message'=>'Creado correctamente'
            ]);

        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }  */
    }

}
