@extends('layouts.layout')

@section('title', 'Product create')

@section('content')
    <h1>Página para crear un producto</h1>
    <form action="{{route('products.store')}}" method="POST">

        @csrf

        <label for="name">Nombre:
            <br>
            <input type="text" name="name" id="name">
        </label>
        <br>
        <label for="description">Description:
            <br>
            <textarea name="description" id="description" cols="20" rows="10"></textarea>
        </label>
        <br>
        <label for="price">Price:
            <br>
            <input type="text" name="price" id="price">
        </label>
        <br>
        <input type="submit" value="Enviar formulario">
    </form>
@endsection
