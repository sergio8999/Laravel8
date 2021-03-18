<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <h1>Header</h1>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <h1>Footer</h1>
    </footer>
</body>
</html>