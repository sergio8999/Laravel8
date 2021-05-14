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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class AdministradorController extends Controller
{
    public function index(){
        return view('administrador.index');
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
                return redirect()->route('administrador.index');
            else {
                return back()->withErrors(['password'=>'Estas credenciales no existen']);
            }
        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }
    } 

/*     public function adminDashboard()
    {
        $users = Administrador::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);


        if(auth()->guard('administrador')->attempt(['name' => request('name'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'administrador']);
            
            $administrador = Administrador::select('administradors.*')->find(auth()->guard('administrador')->user()->id);
            $success =  $administrador;
            $success['token'] =  $administrador->createToken('MyApp',['administrador'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    } */

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
        
        if($request['carousel'] !=""){
            $carousel = $request->file('carousel');
            foreach($carousel as $image){
                $urlImage = Storage::putFile('public', $image);
                $url = explode('/',$urlImage);
                House_Images::set($url[1],$house['id']); 
            }
        }
         

        return redirect()->route('dashboard.addHouse');
    }

    public function getHouse(House $house){
    
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

    public function update(Request $request,House $house){
        $request->validate([
            'name' => 'required|min:3|max:40',
            'host' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'guest' => 'required',
            'bedrooms' => 'required',
            'beds' => 'required',
            'toilets' => 'required',
            'category' => 'required', 
            'location' => 'required' 
        ]);

        try{
             $house->update([
                'name'=>$request['name'],
                'host'=>$request['host'],
                'price'=>$request['price'],
                'description'=>$request['description'],
                'category_id'=>$request['category'],
                'location_id'=>$request['location']
            ]); 
            
            if($request['image'] !=""){
                $image = Storage::putFile('public', $request->file('image')); 
                $url = explode('/',$image);
                $house->update([
                    'url'=>$url[1]
                ]);
            }

            if($request['pool'] == 'on')
                $pool = "true";
            else
                $pool = "false";

            if($request['wifi'] == 'on')
                $wifi = "true";
            else
                $wifi = "false";
            
            $getHouseDetail = House_Detail::where('house_id',$house['id']);
            $getHouseDetail->update([
                'guests'=>$request['guest'],
                'bedrooms'=>$request['bedrooms'],
                'beds'=>$request['beds'],
                'pool'=>$pool,
                'wifi'=>$wifi,
            ]); 
    
            /* Carousel */
            if($request['deletedImages'] != ""){
                $idImages = explode(',',$request['deletedImages']);
                foreach ($idImages as $idImage) {
                    House_Images::where('id',$idImage)->first()->delete();
                };    
            }
                
            if($request['carousel'] !=""){
                $carousel = $request->file('carousel');
                foreach($carousel as $image){
                    $urlImage = Storage::putFile('public', $image);
                    $url = explode('/',$urlImage);
                 House_Images::set($url[1],$house['id']); 
                } 
            }
            
        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }

        return redirect()->route('dashboard.edit',$house); 
    }
}