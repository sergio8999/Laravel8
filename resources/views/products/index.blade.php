@extends('layouts.layout')

@section('title','Product')
    
@section('content')
<h1>Bienvenido a la página principal de productos</h1>
<a href="{{route('products.create')}}">Crear Producto</a>
<ul>
    @foreach ($products as $product)
        <li><a href="{{route('products.show',$product->id)}}">{{$product->name}}</a></li>
    @endforeach
</ul>

{{-- Para mostrar las siguientes páginas de la páginación --}}
{{$products->links()}}
@endsection
