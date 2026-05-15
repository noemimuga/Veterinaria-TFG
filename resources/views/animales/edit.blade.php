@extends('layouts.app')

@section('title', 'Editar Animal - Nubeko')

@section('content')
<div class="contenedor-formulario">
    <div class="tarjeta-formulario">
        <h1 class="titulo-formulario">Editar Datos de {{ $animal->nombre }}</h1>

        <!-- Bloque para capturar y mostrar errores de validación en pantalla -->
        @if ($errors->any())
            <div class="alerta-errores">
                <strong>Por favor, corrige los siguientes campos:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de edición -->
        <form action="{{ route('animales.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            <!-- Nombre -->
            <div class="grupo-input">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $animal->nombre) }}" required>
            </div>

            <div class="fila-doble">
                <!-- Especie -->
                <div class="grupo-input">
                    <label for="especie">Especie</label>
                    <select name="especie" id="especie" required>
                        <option value="perro" {{ old('especie', $animal->especie) === 'perro' ? 'selected' : '' }}>Perro</option>
                        <option value="gato" {{ old('especie', $animal->especie) === 'gato' ? 'selected' : '' }}>Gato</option>
                    </select>
                </div>

                <!-- Raza -->
                <div class="grupo-input">
                    <label for="raza">Raza</label>
                    <input type="text" name="raza" id="raza" value="{{ old('raza', $animal->raza) }}">
                </div>
            </div>

            <div class="fila-doble">
                <!-- Edad -->
                <div class="grupo-input">
                    <label for="edad">Edad (en años)</label>
                    <input type="number" name="edad" id="edad" value="{{ old('edad', $animal->edad) }}">
                </div>

                <!-- Estado -->
                <div class="grupo-input">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" required>
                        <option value="disponible" {{ old('estado', $animal->estado) === 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="en proceso" {{ old('estado', $animal->estado) === 'en proceso' ? 'selected' : '' }}>En Proceso de Adopción</option>
                        <option value="adoptado" {{ old('estado', $animal->estado) === 'adoptado' ? 'selected' : '' }}>Adoptado</option>
                    </select>
                </div>
            </div>

            <!-- Descripción -->
            <div class="grupo-input">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4">{{ old('descripcion', $animal->descripcion) }}</textarea>
            </div>

            <!-- Foto actual y nueva foto -->
            <div class="grupo-input seccion-foto">
                <label>Foto del Animal</label>
                @if($animal->foto)
                    <div class="previsualizacion-foto">
                        <p class="texto-secundario">Foto actual:</p>
                        <img src="{{ asset('storage/' . $animal->foto) }}" alt="Foto actual de {{ $animal->nombre }}">
                    </div>
                @endif
                <div class="input-archivo-wrapper">
                    <span class="texto-secundario">Subir una nueva foto (opcional):</span>
                    <input type="file" name="foto" id="foto" accept="image/*">
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="acciones-formulario">
                <a href="{{ route('refugio.dashboard') }}" class="boton-cancelar-form">Cancelar</a>
                <button type="submit" class="boton-guardar-form">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<style>
    .contenedor-formulario {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }

    .tarjeta-formulario {
        background: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px var(--shadow);
        border: 1px solid var(--beige-200);
    }

    .titulo-formulario {
        font-family: 'Cormorant', serif;
        font-size: 2.2rem;
        color: var(--beige-800);
        margin-bottom: 0.5rem;
    }

    .subtitulo-formulario {
        color: var(--beige-600);
        font-size: 0.95rem;
        margin-bottom: 2rem;
    }

    .alerta-errores {
        background: #f8d7da;
        color: #721c24;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        border-radius: 8px;
        border-left: 5px solid #dc3545;
    }
    .alerta-errores ul {
        margin: 0.5rem 0 0 0;
        padding-left: 1.2rem;
    }

    .grupo-input {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .fila-doble {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .grupo-input label {
        font-weight: 600;
        color: var(--beige-700);
        font-size: 0.95rem;
    }

    .grupo-input input[type="text"],
    .grupo-input input[type="number"],
    .grupo-input select,
    .grupo-input textarea {
        padding: 0.8rem;
        border: 2px solid var(--beige-300);
        border-radius: 10px;
        font-size: 1rem;
        font-family: inherit;
        background-color: white;
        color: var(--beige-900);
        transition: border-color 0.3s;
    }

    .grupo-input input:focus,
    .grupo-input select:focus,
    .grupo-input textarea:focus {
        outline: none;
        border-color: var(--accent);
    }

    .seccion-foto {
        background-color: var(--beige-100);
        padding: 1.5rem;
        border-radius: 10px;
        border: 1px dashed var(--beige-400);
    }

    .previsualizacion-foto img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .acciones-formulario {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 2px solid var(--beige-100);
    }

    .boton-guardar-form,
    .boton-cancelar-form {
        padding: 0.8rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s;
        text-align: center;
    }

    .boton-guardar-form {
        background: #10b981;
        color: white;
        border: none;
    }

    .boton-guardar-form:hover {
        background: #059669;
        transform: translateY(-2px);
    }

    .boton-cancelar-form {
        background: var(--beige-200);
        color: var(--beige-700);
        border: 1px solid var(--beige-300);
    }

    .boton-cancelar-form:hover {
        background: var(--beige-300);
    }

    /* MODO OSCURO (DARK MODE) */
    .dark-mode .tarjeta-formulario {
        background: #2d2d2d;
        border-color: #555;
    }
    .dark-mode .titulo-formulario { color: #f5e6d3; }
    .dark-mode .grupo-input label { color: #f5e6d3; }
    .dark-mode .seccion-foto { background-color: #3a3a3a; border-color: #666; }
    .dark-mode .grupo-input input,
    .dark-mode .grupo-input select,
    .dark-mode .grupo-input textarea {
        background-color: #3a3a3a;
        border-color: #555;
        color: #f5e6d3;
    }

    @media (max-width: 600px) {
        .fila-doble {
            grid-template-columns: 1fr;
            gap: 0;
        }
        .acciones-formulario {
            flex-direction: column-reverse;
        }
    }
</style>
@endsection