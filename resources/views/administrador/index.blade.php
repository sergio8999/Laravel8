@extends('layouts.layout')

@section('content')
<div id="administrador" class="d-flex flex-column align-items-center justify-content-center">
    <h1 class="text-center my-3">Inicie sesión:</h1>
    <form class="mb-3" action="{{route('administrador.login')}}" method="POST">

        @csrf

        <div class="form-group">
            <label for="exampleInputName1">Nombre</label>
            <input type="text" class="form-control" id="exampleInputName1" name="name" value="{{old('name')}}" placeholder="Introduce nombre">

            @error('name')
            <br>
            <small>*{{$message}}</small>
            <br>
            @enderror

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="{{old('password')}}" placeholder="Contraseña">

            @error('password')
            <br>
            <small>*{{$message}}</small>
            <br>
            @enderror

        </div>
        <button type="submit" class="btn btn-dark btn-size">Login</button>
    </form>
</div>
@endsection

