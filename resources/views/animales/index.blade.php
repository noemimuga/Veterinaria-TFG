<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Animales en adopción</title>
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
            padding: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: #3498db;
            color: white;
            border-radius: 5px;
        }

        .filtros {
            margin-bottom: 20px;
        }

        input, select {
            padding: 8px;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<header>
    <h2>🐾 Animales</h2>
    <nav>
        <a href="/">Inicio</a>
        <a href="/animales">Animales</a>
    </nav>
</header>

<div class="container">

    <h1>Animales en adopción</h1>

    <!-- FILTROS -->
    <form method="GET" class="filtros">
        <input type="text" name="buscar" placeholder="Buscar...">

        <select name="especie">
            <option value="">Especie</option>
            <option value="perro">Perro</option>
            <option value="gato">Gato</option>
        </select>

        <input type="number" name="edad" placeholder="Edad">

        <button type="submit">Filtrar</button>
    </form>

    <!-- LISTADO -->
    <div class="grid">

        @forelse($animales as $animal)
            <div class="card">
                <img src="{{ asset('storage/' . $animal->foto) }}" alt="">

                <h3>{{ $animal->nombre }}</h3>
                <p>{{ $animal->raza }}</p>
                <p>Edad: {{ $animal->edad }}</p>
                <p>Estado: {{ $animal->estado }}</p>

                <a href="/animales/{{ $animal->id }}" class="btn">Ver más</a>
            </div>
        @empty
            <p>No hay animales disponibles</p>
        @endforelse

    </div>

</div>

</body>
</html>
