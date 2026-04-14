<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $animal->nombre }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f4f6f8;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
        }

        a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }

        .container {
            padding: 30px;
            max-width: 900px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        h1 {
            margin-top: 15px;
        }

        .info {
            margin-top: 15px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #27ae60;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .estado {
            font-weight: bold;
            margin-top: 10px;
        }

        .volver {
            display: inline-block;
            margin-top: 15px;
            color: #3498db;
        }
    </style>
</head>
<body>

<header>
    <h2>🐾 Detalle del animal</h2>
    <nav>
        <a href="/">Inicio</a>
        <a href="/animales">Animales</a>
    </nav>
</header>

<div class="container">

    <div class="card">

        <!-- IMAGEN -->
        @if($animal->foto)
            <img src="{{ asset('storage/' . $animal->foto) }}" alt="">
        @endif

        <!-- INFO -->
        <h1>{{ $animal->nombre }}</h1>

        <div class="info">
            <p><strong>Especie:</strong> {{ $animal->especie }}</p>
            <p><strong>Raza:</strong> {{ $animal->raza }}</p>
            <p><strong>Edad:</strong> {{ $animal->edad }}</p>
            <p><strong>Descripción:</strong> {{ $animal->descripcion }}</p>

            <p class="estado">
                Estado: {{ $animal->estado }}
            </p>
        </div>

        <!-- BOTÓN ADOPCIÓN -->
        @if($animal->estado == 'disponible')
            <a href="#" class="btn">Solicitar adopción</a>
        @else
            <p style="color:red;">Este animal ya ha sido adoptado</p>
        @endif

        <br>
        <a href="/animales" class="volver">← Volver al listado</a>

    </div>

</div>

</body>
</html>
