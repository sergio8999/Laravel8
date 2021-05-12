<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Category;
use App\Models\House;
use App\Models\House_Detail;
use App\Models\House_Images;
use App\Models\Location;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdministradorController extends Controller
{
    public function index(){
        return view('administrador.login');
    }

   /*  public function dashboard(){
        return view('administrador.dashboard');
    } */

    public function sigUp(Request $request){
        
        $request->validate([
            'name' => 'required|string|unique:administradors',
            'password' => 'required|string'
        ]);

        try{
            Administrador::set($request['name'],$request['password']);

            return response()->json([
                'message' => 'Successfully created administrador!'
            ], 201);
        }catch(Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
        
    }

    public function login(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        try{
            $administrador = Administrador::where('name', $request['name'])->first();

            if($administrador && Hash::check($request['password'], $administrador['password']))
                return redirect()->route('dashboard');
            else {
                /* return "response()->json([
                    'message'=>'Error al loguearse',
                    'status'=>false
                ]);" */
                return back()->withErrors(['password'=>'Estas credenciales no existen']);
            }
        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function houses(){
        $houses = House::orderBy('id','desc')
        ->with('category','details','location')
        ->get();

        return view('administrador.houses',compact('houses'));
    }

    public function destroy(House $house){
        $house->delete();

        return redirect()->route('dashboard.houses');
    }
    
    public function addHouse(){
        try{
            $categories = Category::all();
            $locations = Location::all();
        }catch(Exception $exception){
            return back()->with([
                'message'=>$exception->getMessage()
            ]);
        }

        return view('administrador.addHouse',compact('categories','locations'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:3|max:40',
            'host' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg',
            'description' => 'required',
            'guest' => 'required',
            'bedrooms' => 'required',
            'beds' => 'required',
            'toilets' => 'required',
            'category' => 'required',
            'location' => 'required'
        ]);

        if($request['pool'] == 'on')
            $pool = "true";
        else
            $pool = "false";

        if($request['wifi'] == 'on')
            $wifi = "true";
        else
            $wifi = "false";


        $image = Storage::putFile('public', $request->file('image')); 
        $url = explode('/',$image);
        $house = House::set($request['name'], $request['host'], $request['price'], $url[1], $request['description'],$request['category'],$request['location']) ;
        House_Detail::set($request['beds'],$wifi,$request['guest'],$request['bedrooms'],$request['toilets'],$pool,$house['id']); 
        
         $carousel = $request->file('carousel');
        foreach($carousel as $image){
            $urlImage = Storage::putFile('public', $image);
            $url = explode('/',$urlImage);
            House_Images::set($url[1],$house['id']); 
        } 

        return "correcto";
    }

    public function edit(House $house){
    
        try{
            $categories = Category::all();
            $locations = Location::all();
            $carousel = House_Images::where('house_id',$house['id'])->get();
        }catch(Exception $exception){
            return back()->with([
                'message'=>$exception->getMessage()
            ]);
        }

        return view('administrador.editHouse',compact('house','locations','categories','carousel'));
    }
}