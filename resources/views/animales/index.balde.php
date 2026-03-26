<!-- resources/views/animales/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Animales</title>
</head>
<body>
    <h1>Animales Disponibles</h1>

    <ul>
        @foreach($animales as $animal)
            <li>{{ $animal->nombre }} - {{ $animal->especie }} - {{ $animal->sexo }}</li>
        @endforeach
    </ul>
</body>
</html>
