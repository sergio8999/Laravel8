<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Se suele poner el método __invoke cuando solo contiene una ruta
    public function __invoke(){
        return view('home');
    }
}
