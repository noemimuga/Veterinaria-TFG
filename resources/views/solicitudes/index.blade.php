<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes de adopción</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            margin: 0;
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
            max-width: 1000px;
            margin: auto;
            padding: 30px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        }

        .info {
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            color: white;
            margin-right: 10px;
            text-decoration: none;
            display: inline-block;
        }

        .aceptar {
            background: #27ae60;
        }

        .rechazar {
            background: #e74c3c;
        }

        .estado {
            font-weight: bold;
        }

        .pendiente { color: #f39c12; }
        .aceptada { color: #27ae60; }
        .rechazada { color: #e74c3c; }
    </style>
</head>

<body>

<header>
    <div>🐾 Panel de solicitudes</div>
    <div>
        <a href="{{ route('home') }}">Inicio</a>
    </div>
</header>

<div class="container">

    <h1>Solicitudes de adopción</h1>

    @if($solicitudes->count() == 0)
        <p>No hay solicitudes todavía.</p>
    @endif

    @foreach($solicitudes as $solicitud)

        <div class="card">

            <div class="info">
                <strong>Animal:</strong>
                {{ $solicitud->animal->nombre }}
            </div>

            <div class="info">
                <strong>Usuario:</strong>
                {{ $solicitud->user->name ?? 'Usuario' }}
            </div>

            <div class="info">
                <strong>Estado:</strong>
                <span class="estado {{ $solicitud->estado }}">
                    {{ ucfirst($solicitud->estado) }}
                </span>
            </div>

            <div class="info">
                <strong>Fecha:</strong>
                {{ $solicitud->created_at->format('d/m/Y') }}
            </div>

            @if($solicitud->estado == 'pendiente')

                <form action="{{ route('solicitudes.aceptar', $solicitud->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button class="btn aceptar">Aceptar</button>
                </form>

                <form action="{{ route('solicitudes.rechazar', $solicitud->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button class="btn rechazar">Rechazar</button>
                </form>

            @endif

        </div>

    @endforeach

</div>

</body>
</html>
