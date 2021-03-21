@extends('layouts.layout')

@section('title','Contact')
    
@section('content')
    <h1>Dejanos un mensaje</h1>

    <form action="{{route('contact.store')}}" method="POST">
        
        @csrf

        <label for="name">
            Nombre
            <br>
            <input type="text" name="name" id="name">
        </label>
        <br>

        @error('name')
            <p><strong>{{$message}}</strong></p>
        @enderror

        <label for="email">
            Correo
            <br>
            <input type="text" name="email" id="email">
        </label>
        <br>

        @error('email')
            <p><strong>{{$message}}</strong></p>
        @enderror


        <label for="message">
            Mensaje
            <br>
            <textarea name="message" id="message" cols="20" rows="10"></textarea>
        </label>
        <br>

        @error('message')
            <p><strong>{{$message}}</strong></p>
        @enderror

        <input type="submit" value="Enviar Mensaje">
    </form>

    @if (session('info'))
        <script>
            alert("{{session('info')}}")
        </script>
    @endif

@endsection