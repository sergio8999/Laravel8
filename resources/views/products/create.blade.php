@extends('layouts.layout')

@section('title', 'Product create')

@section('content')
    <h1>Página para crear un producto</h1>
    <form action="{{route('products.store')}}" method="POST">

        @csrf

        <label for="name">Nombre:
            <br>
            <input type="text" name="name" id="name" value="{{old('name')}}">
        </label>

        @error('name')
            <br>
            <small>*{{$message}}</small>
            <br>
        @enderror

        <br>
        <label for="description">Description:
            <br>
            <textarea name="description" id="description" cols="20" rows="10">{{old('description')}}</textarea>
        </label>

        @error('description')
            <br>
            <small>*{{$message}}</small>
            <br>
        @enderror

        <br>
        <label for="price">Price:
            <br>
            <input type="text" name="price" id="price" value="{{old('price')}}">
        </label>

        @error('price')
            <br>
            <small>*{{$message}}</small>
            <br>
        @enderror

        <br>
        <input type="submit" value="Enviar formulario">
    </form>
@endsection
