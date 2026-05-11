@extends('layouts.app')

@section('title', 'Panel del Refugio')

@section('content')

<div class="container">

    <h1 class="mb-4">Panel del Refugio</h1>

    <div class="stats-grid">

    <div class="stat-card">
        <h2>{{ $animales->count() }}</h2>
        <p>Animales publicados</p>
    </div>

    <div class="stat-card">
        <h2>{{ $solicitudesPendientes }}</h2>
        <p>Solicitudes pendientes</p>
    </div>

</div>

    <div class="grid">

        <div class="card">
            <h2>🐶 Gestionar animales</h2>
            <p>Crear, editar y eliminar animales.</p>

            <a href="{{ route('animales.create') }}" class="btn">
                Añadir animal
            </a>
        </div>

        <div class="card">
            <h2>📩 Solicitudes</h2>
            <p>Gestionar solicitudes de adopción.</p>

            <a href="{{ route('solicitudes.index') }}" class="btn">
                Ver solicitudes
            </a>
        </div>

    </div>

</div>

@endsection
