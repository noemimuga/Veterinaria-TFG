<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Aceptada</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fdf7f0;
            color: #5a4a3c;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h1 {
            color: #8b7355;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            background-color: #d4a574;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 50px;
            margin-top: 20px;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #a18f7b;
            text-align: center;
        }
        @media (max-width: 480px){
            .container {
                padding: 20px;
            }
            h1 {
                font-size: 20px;
            }
            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Tu solicitud fue aceptada! 🎉</h1>
        <p>Hola {{ $solicitud->user->name }},</p>
        <p>¡Felicitaciones! Tu solicitud de adopción para <strong>{{ $solicitud->animal->nombre }}</strong> ha sido aceptada por el refugio.</p>
        <p>El animal ahora está oficialmente adoptado, y el refugio se pondrá en contacto contigo para los siguientes pasos.</p>
        <a href="{{ route('adopta.show', $solicitud->animal->id) }}" class="btn">Ver detalles del animal</a>
        <div class="footer">
            Este correo es automático, por favor no respondas.
        </div>
    </div>
</body>
</html>
