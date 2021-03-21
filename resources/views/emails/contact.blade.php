<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h1{
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Correo electrónico</h1>
    <p>Correo de prueba</p>
    <p><strong>Nombre:</strong>{{$contact['name']}}</p>
    <p><strong>Email:</strong>{{$contact['email']}}</p>
    <p><strong>Mensaje:</strong>{{$contact['message']}}</p>
</body>
</html>