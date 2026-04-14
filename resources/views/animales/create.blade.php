<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir animal</title>
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
        max-width: 650px;
        margin: auto;
        padding: 30px;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }

    h2 {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 12px;
        margin-bottom: 5px;
    }

    input, select, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        transition: 0.2s;
        font-size: 14px;
    }

    input:focus, select:focus, textarea:focus {
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52,152,219,0.3);
    }

    textarea {
        resize: none;
        height: 100px;
    }

    button {
        margin-top: 20px;
        padding: 12px;
        background: #27ae60;
        color: white;
        border: none;
        width: 100%;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background: #219150;
    }

    form {
    margin-top: 10px;
    }

    input, select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    font-size: 14px;

    box-sizing: border-box; /* 👈 CLAVE */
   }
</style>
</head>
<body>

<header>
    <h2>🐾 Añadir animal</h2>
    <nav>
        <a href="/">Inicio</a>
        <a href="/animales">Animales</a>
    </nav>
</header>

<div class="container">

    <div class="card">

        <h2>🐾 Añadir nuevo animal</h2>

        <form action="{{ route('animales.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Nombre</label>
            <input type="text" name="nombre" required>

            <label>Especie</label>
            <select name="especie" required>
                <option value="">Selecciona</option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
            </select>

            <label>Raza</label>
            <input type="text" name="raza">

            <label>Edad</label>
            <input type="number" name="edad">

            <label>Descripción</label>
            <textarea name="descripcion"></textarea>

            <label>Foto</label>
            <input type="file" name="foto">

            <button type="submit">Guardar animal</button>

        </form>

    </div>

</div>
</body>
</html>
