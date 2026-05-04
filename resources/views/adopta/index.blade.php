@extends('layouts.app')

@section('title', 'Listado de Animales - Refugio Nubeko')

@section('content')
<div class="container">
    <h1 class="text-center">Animales en adopción</h1>

    {{-- Formulario de filtros --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('adopta.index') }}" method="GET">
                <div class="row g-3">
                    {{-- Búsqueda general --}}
                    <div class="col-md-3">
                        <label for="buscar" class="form-label">Buscar</label>
                        <input
                            type="text"
                            class="form-control"
                            id="buscar"
                            name="buscar"
                            placeholder="Nombre o raza"
                            value="{{ request('buscar') }}">
                    </div>

                    {{-- Filtro de especie --}}
                    <div class="col-md-2">
                        <label for="especie" class="form-label">Especie</label>
                        <select class="form-select" id="especie" name="especie">
                            <option value="">Todas</option>
                            <option value="perro" {{ request('especie') == 'perro' ? 'selected' : '' }}>Perro</option>
                            <option value="gato" {{ request('especie') == 'gato' ? 'selected' : '' }}>Gato</option>
                        </select>
                    </div>

                    {{-- Filtro de raza --}}
                    <div class="col-md-2">
                        <label for="raza" class="form-label">Raza</label>
                        <input
                            type="text"
                            class="form-control"
                            id="raza"
                            name="raza"
                            placeholder="Raza"
                            value="{{ request('raza') }}">
                    </div>

                    {{-- Filtro de edad --}}
                    <div class="col-md-2">
                        <label for="edad" class="form-label">Edad</label>
                        <select class="form-select" id="edad" name="edad">
                            <option value="">Todas</option>
                            <option value="cachorro" {{ request('edad') == 'cachorro' ? 'selected' : '' }}>Cachorro (0-1 año)</option>
                            <option value="joven" {{ request('edad') == 'joven' ? 'selected' : '' }}>Joven (1-3 años)</option>
                            <option value="adulto" {{ request('edad') == 'adulto' ? 'selected' : '' }}>Adulto (3-7 años)</option>
                            <option value="senior" {{ request('edad') == 'senior' ? 'selected' : '' }}>Senior (7+ años)</option>
                        </select>
                    </div>

                    {{-- Filtrar por sexo --}}
                    <div class="col-md-2">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" id="sexo" name="sexo">
                            <option value="">Todas</option>
                            {{-- CORREGIDO: Los value deben ser Hembra/Macho, no perro/gato --}}
                            <option value="Hembra" {{ request('sexo') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                            <option value="Macho" {{ request('sexo') == 'Macho' ? 'selected' : '' }}>Macho</option>
                        </select>
                    </div>

                    {{-- Botones --}}
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                </div>

                {{-- Botón para limpiar filtros --}}
                @if(request()->anyFilled(['buscar', 'especie', 'raza', 'edad', 'localizacion']))
                <div class="row mt-2">
                    <div class="col-12">
                        <a href="{{ route('adopta.index') }}" class="btn btn-secondary btn-sm">Limpiar filtros</a>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    <!-- El Grid donde se mostrarán los animales -->
    <div class="grid">
        @forelse($animales as $animal)
        <div class="card">
            <!-- Imagen del animal -->
            <img src="{{ asset('storage/' . $animal->foto) }}" alt="{{ $animal->nombre }}">

            <div class="card-body">
                <h3>{{ $animal->nombre }}</h3>
                <p><strong>Raza:</strong> {{ $animal->raza }}</p>
                <p><strong>Edad:</strong> {{ $animal->edad }} años</p>

                <a href="{{ route('animales.show', $animal->id) }}" class="btn">Conocer a {{ $animal->nombre }}</a>
            </div>
        </div>
        @empty
        <div class="no-results">
            <p>Actualmente no hay animales disponibles para adopción.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
    }

    .card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 20px var(--shadow);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .card-body {
        padding: 1.5rem;
    }

    .btn {
        display: block;
        text-align: center;
        background: var(--accent);
        color: white;
        padding: 0.8rem;
        border-radius: 10px;
        text-decoration: none;
        margin-top: 1rem;
    }
</style>
@endsection