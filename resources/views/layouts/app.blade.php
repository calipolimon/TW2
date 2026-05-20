<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Artesanal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f5ede1; 
        }

        header { background-color: #a0826d; padding: 20px; color: white; }
        header h1 { 
            margin: 0; 
            font-size: 50px;
            font-family: 'Georgia', serif; 
            font-weight: bold;
        }
        nav a { color: white; text-decoration: none; margin: 0 15px; }
        nav a:hover { text-decoration: underline; }
        .sidebar { background-color: #d4c4b0; padding: 15px; margin: 20px 0; }
        .carrito-boton { cursor: pointer; font-size: 24px; text-decoration: none; position: relative; }
        .carrito-panel {
            position: fixed;
            right: -350px;
            top: 0;
            width: 350px;
            height: 100vh;
            background-color: #fff;
            box-shadow: -2px 0 8px rgba(0,0,0,0.2);
            z-index: 1000;
            overflow-y: auto;
            transition: right 0.3s ease;
            padding: 20px;
        }
        #carrito-toggle:checked ~ .carrito-panel {
            right: 0;
        }
        .carrito-cerrar {
            background: #a0826d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            float: right;
            border-radius: 3px;
        }
        .carrito-titulo {
            clear: both;
            color: #5d4e37;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .carrito-contenido {
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0; background-color: #f5ede1;">
    @include('partials.carrito')
    @include('layouts.header')

    <div class="container-fluid" style="margin-top: 20px; flex: 1;">
        @yield('content')
    </div>

    @include('layouts.footer')
</body>
</html>
