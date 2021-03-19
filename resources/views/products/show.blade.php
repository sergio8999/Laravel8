@extends('layouts.layout')

@section('title', 'Product ' . $product->name)
@section('content')
    <h1>Página de producto {{$product->name}}</h1>
    <a href="{{route('products.index')}}">Volver a productos</a>
    <a href="{{route('products.edit',$product)}}">Editar curso</a>
    <p>Descripción: {{$product->description}}</p>
@endsection