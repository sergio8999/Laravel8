<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{mix('css/app.css')}}?{{date('YmdHis')}}" type="text/css">
</head>
<body>
    <div id="administrador" class="d-flex flex-column align-items-center justify-content-center">
        <h1 class="text-center mb-3">Inicie sesión:</h1>
        <form class="mb-3" action="{{route('administrador.login')}}" method="POST">
    
            @csrf
    
            <div class="form-group">
                <label for="exampleInputName1">Email</label>
                <input type="text" class="form-control" id="exampleInputName1" name="email" value="{{old('email')}}" placeholder="Introduce email">
    
                @error('email')
                <br>
                <small class="active">*{{$message}}</small>
                <br>
                @enderror
    
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="{{old('password')}}" placeholder="Contraseña">
    
                @error('password')
                <br>
                <small class="active">*{{$message}}</small>
                <br>
                @enderror
            </div>

            @error('administrador')
                <br>
                <small class="active">*{{$message}}</small>
                <br>
            @enderror
            
            <button type="submit" class="btn btn-dark btn-size">Login</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>

