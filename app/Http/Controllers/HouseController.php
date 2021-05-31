<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditHouseRequest;
use App\Http\Requests\StoreHouseRequest;
use App\Models\Category;
use App\Models\House;
use App\Models\House_Detail;
use App\Models\House_Images;
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
            ->with('details','images','category','location')
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

            $category = Category::where('id',$id)->first();

            if($houses == null )
                return response()->json([
                    'houses'=> 404
                ]);

            return response()->json([
                'houses'=> $houses,
                'category'=> $category['name']
            ]);
        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function store(StoreHouseRequest $request){

        /* $request->validate([
            'name' => 'required|min:3|max:40',
            'host' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg',
            'description' => 'required',
            'guest' => 'required',
            'bedrooms' => 'required',
            'beds' => 'required',
            'toilets' => 'required',
            'pool' => 'required',
            'wifi' => 'required',
            'category_id' => 'required',
            'location_id' => 'required'
        ]); */

        
        try{ 
            $image = Storage::putFile('public', $request->file('image')); 
            $url = explode('/',$image);
            $house = House::set($request['name'], $request['host'], $request['price'], $url[1], $request['description'],$request['category_id'],$request['location_id']);
            House_Detail::set($request['beds'],$request['wifi'],$request['guest'],$request['bedrooms'],$request['toilets'],$request['pool'],$house['id']);
            return response()->json([
                'message'=>'Creado correctamente'
            ]);

        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }   
    }

    public function storeCarousel(Request $request){
        try{
            $house = House::all()->last();
            foreach($request->file() as $image){
                $urlImage = Storage::putFile('public', $image); 
                $url = explode('/',$urlImage);
                House_Images::set($url[1],$house['id']);
            }

            return response()->json([
                'message' =>'Realizado correctamente'
            ]);

        }catch(Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function destroy(Request $house){
        try{
            House::where('id', '=',$house['id'])->delete();
            return response()->json([
                'message'=>'Borrado correctamente'
            ]);
        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function edit(EditHouseRequest $house){

        /* $house->validate([
            'name' => 'required|min:3|max:40',
            'host' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'guest' => 'required',
            'bedrooms' => 'required',
            'beds' => 'required',
            'toilets' => 'required',
            'pool' => 'required',
            'wifi' => 'required',
            'category_id' => 'required',
            'location_id' => 'required'
        ]); */

        try{
            $getHouse = House::where('id', '=' , $house['id'])->first();
            $getHouse->update([
                'name'=>$house['name'],
                'host'=>$house['host'],
                'price'=>$house['price'],
                'description'=>$house['description'],
                'category_id'=>$house['category_id'],
                'location_id'=>$house['location_id']
            ]);
            
            if($house['image'] !=null){
                $image = Storage::putFile('public', $house->file('image')); 
                $url = explode('/',$image);
                $getHouse->update([
                    'url'=>$url[1]
                ]);
            }
            

            $getHouse->update([
                'guests'=>$house['guest'],
                'bedrooms'=>$house['bedrooms'],
                'beds'=>$house['beds'],
                'pool'=>$house['pool'],
                'wifi'=>$house['wifi'],
            ]);

            return response()->json([
                'message'=>'Actualizado correctamente'
            ]);

        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }
    }
}
