@extends('layouts.layout')

@section('title','Login')

@section('content')
    <form action="{{route('login.login')}}" method="POST">
        @csrf

        <label for="email">Email:
            <br>
            <input type="email" id="email" name="email">
        </label>

        @error('email')
            <br>
            <small>*{{$message}}</small>
            <br>
        @enderror

        <br>
        <label for="password">Password:
            <br>
            <input type="password" id="password" name="password">
        </label>

        @error('password')
            <br>
            <small>*{{$message}}</small>
            <br>
        @enderror

        <br>
        <input type="submit" name="enviar" value="enviar">
    </form>
@endsection