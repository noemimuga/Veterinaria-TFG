<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Adopciones de Animales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
        }

        header {
            background-color: #2c3e50;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .hero {
            text-align: center;
            padding: 80px 20px;
            background-color: #3498db;
            color: white;
        }

        .hero h1 {
            font-size: 40px;
        }

        .hero p {
            font-size: 18px;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #1a252f;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <h2>🐾 Adopciones</h2>
    <nav>
        <a href="/">Inicio</a>
        <a href="/animales">Animales</a>
        <a href="/login">Login</a>
        <a href="/register">Registro</a>
    </nav>
</header>

<section class="hero">
    <h1>Encuentra a tu nuevo mejor amigo</h1>
    <p>Adopta un perro o gato y dale una segunda oportunidad</p>

    <a href="/animales" class="btn">Ver animales</a>
</section>

<footer>
    <p>© 2026 Plataforma de Adopciones</p>
</footer>

</body>
</html>
