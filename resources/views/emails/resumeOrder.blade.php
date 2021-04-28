<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de pedido</title>
</head>
<body>
    <h1>Datos de la reserva</h1>
    <h3>Casa: {{$order['nameHouse']}}</h3>


    <table class="table table-striped">
  <thead>
    <tr>
        <th scope="col">D. Llegada</th>
        <th scope="col">H. Llegada</th>
        <th scope="col">D. Salida</th>
        <th scope="col">H. Salida</th>
        <th scope="col">Precio</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>{{$order['arrivalDay']}}</td>
        <td>{{$order['arrivalTime']}}</td>
        <td>{{$order['departureDay']}}</td>
        <td>{{$order['departureTime']}}</td>
        <td>{{$order['subtotal']}}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td><b>Impuestos</b></td>
        <td>{{$order['taxes']}}</td>
    </tr>
    <tr>
        <td colspan="3"> </td>
        <td><b>Precio total</b></td>
        <td>{{$order['totalPrices']}}</td>
    </tr>
  </tbody>
</table>
</body>
</html>