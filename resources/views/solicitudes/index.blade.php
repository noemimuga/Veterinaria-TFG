<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de adopción</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding-bottom: 40px;
        }

        header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav a {
            color: #4a5568;
            text-decoration: none;
            margin-left: 30px;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav a:hover {
            color: #667eea;
        }

        .nav a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #667eea;
            transition: width 0.3s ease;
        }

        .nav a:hover::after {
            width: 100%;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 30px;
        }

        h1 {
            color: white;
            font-size: 36px;
            margin-bottom: 30px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .empty-state {
            background: white;
            padding: 60px 40px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .empty-state p {
            color: #718096;
            font-size: 18px;
            margin-top: 20px;
        }

        .empty-icon {
            font-size: 64px;
            opacity: 0.3;
        }

        .card {
            background: white;
            padding: 30px;
            margin-bottom: 20px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid #667eea;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .animal-name {
            font-size: 22px;
            font-weight: 700;
            color: #2d3748;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #a0aec0;
            font-weight: 600;
        }

        .info-value {
            font-size: 16px;
            color: #2d3748;
            font-weight: 500;
        }

        .estado-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pendiente {
            background: #fef3c7;
            color: #92400e;
        }

        .aceptada {
            background: #d1fae5;
            color: #065f46;
        }

        .rechazada {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .pendiente .status-dot {
            background: #f59e0b;
        }

        .aceptada .status-dot {
            background: #10b981;
        }

        .rechazada .status-dot {
            background: #ef4444;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .actions {
            display: flex;
            gap: 12px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            flex: 1;
            padding: 14px 24px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .btn:active {
            transform: translateY(0);
        }

        .aceptar {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .aceptar:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }

        .rechazar {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .rechazar:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
            }

            .nav {
                width: 100%;
                text-align: center;
            }

            .nav a {
                margin: 0 15px;
            }

            h1 {
                font-size: 28px;
            }

            .card {
                padding: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="header-content">
        <div class="logo">
            🐾 Panel de solicitudes
        </div>
        <nav class="nav">
            <a href="{{ route('home') }}">Inicio</a>
        </nav>
    </div>
</header>

<div class="container">

    <h1>Solicitudes de adopción</h1>

    @if($solicitudes->count() == 0)
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <p>No hay solicitudes todavía.</p>
        </div>
    @endif

    @foreach($solicitudes as $solicitud)

        <div class="card">

            <div class="card-header">
                <div class="animal-name">
                    {{ $solicitud->animal->nombre }}
                </div>
                <span class="estado-badge {{ $solicitud->estado }}">
                    <span class="status-dot"></span>
                    {{ ucfirst($solicitud->estado) }}
                </span>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Usuario</span>
                    <span class="info-value">{{ $solicitud->user->name ?? 'Usuario' }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Fecha de solicitud</span>
                    <span class="info-value">{{ $solicitud->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            @if($solicitud->estado == 'pendiente')

                <div class="actions">
                    <form action="{{ route('solicitudes.aceptar', $solicitud->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('PATCH')
                        <button class="btn aceptar">
                            ✓ Aceptar solicitud
                        </button>
                    </form>

                    <form action="{{ route('solicitudes.rechazar', $solicitud->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('PATCH')
                        <button class="btn rechazar">
                            ✗ Rechazar solicitud
                        </button>
                    </form>
                </div>

            @endif

        </div>

    @endforeach

</div>

</body>
</html>