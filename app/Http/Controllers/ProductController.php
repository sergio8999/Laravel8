<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // se puede poner el nombre que se quiera en el metodo
    public function index(){
        return view('products.index');
    }

    public function create(){
        return view('products.create');
    }

    public function show($name){ 
        // Se pasa en arrayel nombre que deamos y la variable
       /*  return view('products.show',['nombre'=> $nombre]); */

       // Si se llama igual el nombre que se asocia la variable se puede poner con compact
       return view('products.show',compact('name'));
    }
}
