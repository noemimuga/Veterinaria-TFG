@extends('layouts.app')

@section('title', 'Mi Cuenta')

@section('content')

<div class="profile-container">

    <h1 class="title">Mi Cuenta</h1>

    <div class="profile-grid">

        {{-- INFO --}}
        <div class="profile-card">

            <h2>Información personal</h2>

            <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

            <p><strong>Rol:</strong> {{ Auth::user()->tipo ?? 'Usuario' }}</p>

        </div>

        {{--OPCIONES --}}
        <div class="profile-card">

            <h2>Opciones</h2>

            <a href="{{ route('profile.custom') }}" class="btn">
                Ver perfil
            </a>

            <form method="POST" action="{{ route('logout') }}" style="margin-top:10px;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Cerrar sesión
                </button>
            </form>

        </div>

        {{-- FAVORITOS -  Solo se muestra si no es un refugio--}}
        @if(Auth::user()->tipo !== 'refugio')
        <div class="profile-card">
            <h2>Favoritos</h2>
            <p>Aquí verás tus animales guardados.</p>
            <a href="{{ route('favoritos.index') }}" class="btn">
                Ver favoritos
            </a>
        </div>
        @endif

        {{-- REFUGIO - Solo se muestra si es un refugio--}}
        @if(Auth::user()->tipo === 'refugio')
        <div class="profile-card highlight">
            <h2>Panel Refugio</h2>
            <p>Gestiona animales y solicitudes.</p>
            <a href="{{ route('refugio.dashboard') }}" class="btn">
                Ir al panel
            </a>
        </div>
        @endif

    </div>
</div>

@endsection

@section('extra-styles')

<style>
    .profile-container {
        max-width: 1100px;
        margin: auto;
        padding: 40px 20px;
    }

    .title {
        text-align: center;
        margin-bottom: 40px;
        color: #8b7355;
        font-size: 2.5rem;
        font-family: 'Cormorant', serif;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .profile-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: 0.3s;
    }

    .profile-card:hover {
        transform: translateY(-3px);
    }

    .profile-card h2 {
        margin-bottom: 15px;
        color: #8b7355;
    }

    .profile-card p {
        margin: 8px 0;
        color: #555;
    }

    .btn {
        display: block;
        text-align: center;
        padding: 10px;
        margin-top: 15px;
        background: #d4a574;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn:hover {
        background: #b8865a;
    }

    .btn-danger {
        background: #c0392b;
    }

    .btn-danger:hover {
        background: #a93226;
    }

    .highlight {
        border: 2px solid #d4a574;
    }
</style>

@endsection