<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // se puede poner el nombre que se quiera en el metodo
    public function index(){
        //Mostrar todos los registros
        /* $products = Product::all(); */

        // Paginar
        $products = Product::orderBy('id','desc')->paginate();
        return view('products.index',compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();

        // redirigir al producto creado
        return redirect()->route('products.show',$product->id);

        /*
            Laravel también acepta poner:
            return redirect()->route('products.show',$product);
            Toma id por defecto
        */
    }

    public function show($id){ 
        // Se pasa en arrayel nombre que deamos y la variable
       /*  return view('products.show',['nombre'=> $nombre]); */

       $product = Product::find($id);
        
       // Si se llama igual el nombre que se asocia la variable se puede poner con compact
       return view('products.show',compact('product'));
    }

    public function edit($id){
        $product = Product::find($id);

        return $product;
    }  
}
