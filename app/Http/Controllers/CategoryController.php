<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function categories(){
        try{
            $categories = Category::all();
            return response()->json([
                'categories'=>$categories
            ]);
        }catch(Exception $exception){
            return response()->json([
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function show($id){ 
        try{
            $categories = Category::where('id',$id)
            ->with('houses')
            ->first();

            if($categories == null)
                return response()->json([
                    'categories'=> 404
                ]);

            return response()->json([
                'categories'=> $categories
            ]);
        }catch(Exception $exception){
            return response()->json([
                'message'=> $exception->getMessage()
            ]);
        }
    }
}
