<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProductduct;

class ProductController extends Controller
{
    // se puede poner el nombre que se quiera en el metodo
    public function products(){
        //Mostrar todos los registros
        /* $products = Product::all(); */

        // Paginar
        $products = Product::orderBy('id','desc')->get();
        /*return view('products.index',compact('products')); */
        /* return response()->json([
            'id' => $products->id,
            'name' => $products->name,
            'description' => $products->description,
            'price' => $products->price
        ], 201);  */
        return $products;
    }


    public function value(){
        return "value";
    }

    public function create(){
        return view('products.create');
    }

    public function store(Product $request){


        // esto es una forma cuando son pocos
       /*  $request->validate([
            'name'=>'required|max:10',
            'description'=>'required|min:2',
            'price'=>'required|numeric'
        ]); */

        /* $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save(); */

        //Para crear un producto con create 
        /* $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]); */
    
            
        // Crear producto por asignación masiva
        $product = Product::create($request->all());
        
        // redirigir al producto creado
        return redirect()->route('products.show',$product);

        /*
            Laravel también acepta poner:
            return redirect()->route('products.show',$product);
            Toma id por defecto
        */
    }

    public function show(Product $product){ 
        // Se pasa en arrayel nombre que deamos y la variable
       /*  return view('products.show',['nombre'=> $nombre]); */

       /* $product = Product::find($id); */
        
       // Si se llama igual el nombre que se asocia la variable se puede poner con compact
       return view('products.show',compact('product'));
    }

    public function edit(Product $product){
        /* $product = Product::find($id);

        return $product;*/
        return view('products.edit',compact('product'));
    }  

    public function update(Request $request,Product $product){

        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required'
        ]); 

        /* $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save(); */

        $product->update($request->all());

        return view('products.show',compact('product'));
    }

    public function destroy(Product $product){
        $product->delete();

        return redirect()->route('products.index');
    }
}
