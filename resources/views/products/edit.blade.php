@extends('layouts.layout')

@section('title','Product edit')
    
@section('content')
<h1>Página para editar un producto</h1>
<form action="{{route('products.update',$product)}}" method="POST">

    @csrf

    @method('put')

    <label for="name">Nombre:
        <br>
        <input type="text" name="name" id="name" value="{{old('name', $product->name)}}">
    </label>

    @error('name')
            <br>
            <small>*{{$message}}</small>
            <br>
    @enderror

    <br>
    <label for="description">Description:
        <br>
        <textarea name="description" id="description" cols="20" rows="10">{{old('description', $product->description)}}</textarea>
    </label>

    @error('description')
            <br>
            <small>*{{$message}}</small>
            <br>
    @enderror

    <br>
    <label for="price">Price:
        <br>
        <input type="text" name="price" id="price" value="{{old('price', $product->price)}}">
    </label>
    @error('price')
            <br>
            <small>*{{$message}}</small>
            <br>
    @enderror

    <br>
    <input type="submit" value="Actualizar formulario">
</form>
@endsection