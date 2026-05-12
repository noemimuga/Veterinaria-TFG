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
            <h2>Gestionar animales</h2>
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

@section('extra-styles')

<style>

.container{
    max-width:1200px;
    margin:auto;
    padding:40px 20px;
}

h1{
    text-align:center;
    margin-bottom:40px;
    color:#8b7355;
    font-size:2.5rem;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:40px;
}

.stat-card{
    background:white;
    padding:2rem;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    text-align:center;
}

.stat-card h2{
    font-size:3rem;
    color:#8b7355;
    margin-bottom:10px;
}

.stat-card p{
    color:#666;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
    gap:25px;
}

.card{
    background:white;
    padding:2rem;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.card h2{
    color:#8b7355;
    margin-bottom:15px;
}

.card p{
    color:#666;
    margin-bottom:20px;
}

.btn{
    display:inline-block;
    width:100%;
    text-align:center;
    padding:12px;
    background:#d4a574;
    color:white;
    border:none;
    border-radius:8px;
    text-decoration:none;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    background:#b8865a;
}

@media (max-width:768px){

    h1{
        font-size:2rem;
    }

    .grid{
        grid-template-columns:1fr;
    }

    .stats-grid{
        grid-template-columns:1fr;
    }

}
</style>

@endsection
