<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        return view('contact.index');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $correo = new ContactMailable($request->all());
        Mail::to('sergio8999@gmail.com')->send($correo);
        return redirect()->route('contact.index')->with('info',"Mensaje enviado");
    }
}
