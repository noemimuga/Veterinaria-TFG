@extends('layouts.app')

@section('title', $animal->nombre . ' - Detalle de Adopción')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container-detalle">
        <div class="card-detalle">
            {{-- Sección de Imagen --}}
            <div class="detalle-header">
                <div class="image-wrapper">
                    @if($animal->foto)
                        <img src="{{ asset('storage/' . $animal->foto) }}" alt="{{ $animal->nombre }}">
                    @else
                        <div class="no-image-placeholder">🐾</div>
                    @endif

                    <div class="estado-tag {{ $animal->estado }}">
                        {{ $animal->estado == 'disponible' ? '✓ Disponible' : 'Adoptado' }}
                    </div>
                </div>
            </div>

            {{-- Sección de Información --}}
            <div class="detalle-body">
                <h1 class="animal-name">{{ $animal->nombre }}</h1>

                <div class="info-chips">
                    <div class="chip">
                        <span class="label">Especie</span>
                        <span class="value">{{ $animal->especie }}</span>
                    </div>
                    <div class="chip">
                        <span class="label">Raza</span>
                        <span class="value">{{ $animal->raza }}</span>
                    </div>
                    <div class="chip">
                        <span class="label">Edad</span>
                        <span class="value">{{ $animal->edad }}</span>
                    </div>
                </div>

                <div class="descripcion-box">
                    <h3>Conoce a {{ $animal->nombre }}</h3>
                    <p>{{ $animal->descripcion }}</p>
                </div>

                {{-- CONTENEDOR DE BOTONES CORREGIDO --}}
                <div class="acciones-detalle" style="display: flex; justify-content: center; align-items: center; gap: 1rem; flex-wrap: wrap; margin-top: 2rem;">
                    
                    @auth
                        {{-- Logueado: Verificamos estado y tipo de usuario --}}
                        @if($animal->estado == 'disponible')
                            @if(Auth::user()->tipo !== 'refugio')
                                <a href="{{ route('solicitudes.create', $animal->id) }}" class="btn-principal-nubeko"
                                style="width:300px">
                                    Solicitar Adopción
                                </a>
                            @endif
                        @else
                            <div class="msg-adoptado" style="font-weight: bold; color: var(--beige-600);">
                                Este pequeño ya encontró un hogar
                            </div>
                        @endif

                        {{-- Favoritos (solo si no es refugio) --}}
                        @if(Auth::user()->tipo !== 'refugio')
                            <form action="{{ route('favoritos.store', $animal->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="btn-favorito">
                                    Añadir a favoritos
                                </button>
                            </form>
                        @endif

                    @else
                        {{-- No logueado: Botón de Login --}}
                        <a href="{{ route('login') }}" class="btn-principal-nubeko">
                            Inicia sesión para adoptar
                        </a>
                    @endauth

                    {{-- Botón Volver (Siempre visible y alineado) --}}
                    <a href="{{ route('adopta.index') }}" class="btn-secundario-nubeko" style="text-decoration: underline;">
                         Volver a la lista
                    </a>
                </div> 

            </div>
        </div> 
    </div> 
@endsection
@section('extra-styles')
<style>
    .container-detalle {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Breadcrumb */
    .breadcrumb-nubeko {
        margin-bottom: 2rem;
        font-size: 0.9rem;
        color: var(--beige-500);
    }

    .breadcrumb-nubeko a {
        color: var(--beige-500);
        text-decoration: none;
        transition: color 0.3s;
    }

    .breadcrumb-nubeko a:hover {
        color: var(--accent);
    }

    .breadcrumb-nubeko .sep {
        margin: 0 10px;
        opacity: 0.5;
    }

    .breadcrumb-nubeko .current {
        color: var(--beige-800);
        font-weight: 700;
    }

    /* Card Principal */
    .card-detalle {
        background: var(--white);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 30px var(--shadow);
        border: 1px solid var(--beige-200);
        display: grid;
        grid-template-columns: 1fr 1.2fr;
    }

    .image-wrapper {
        position: relative;
        height: 100%;
        min-height: 450px;
        background: var(--beige-100);
    }

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        font-size: 5rem;
        opacity: 0.2;
    }

    .estado-tag {
        position: absolute;
        top: 20px;
        left: 20px;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        backdrop-filter: blur(8px);
    }

    .estado-tag.disponible {
        background: rgba(255, 255, 255, 0.9);
        color: #8b7355;
    }

    .estado-tag.adoptado {
        background: var(--beige-700);
        color: white;
    }

    /* Contenido */
    .detalle-body {
        padding: 3rem;
    }

    .animal-name {
        font-family: 'Cormorant', serif;
        font-size: 3.5rem;
        color: var(--beige-800);
        margin-bottom: 1.5rem;
        line-height: 1;
    }

    .info-chips {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .chip {
        flex: 1;
        background: var(--beige-50);
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid var(--beige-200);
    }

    .chip .label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        color: var(--beige-500);
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .chip .value {
        font-weight: 700;
        color: var(--beige-700);
    }

    .descripcion-box h3 {
        font-family: 'Cormorant', serif;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--beige-700);
    }

    .descripcion-box p {
        color: var(--beige-600);
        line-height: 1.8;
        margin-bottom: 2.5rem;
    }

    /* Botones */
    .acciones-detalle {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .btn-principal-nubeko {
        background: var(--accent);
        color: white;
        text-align: center;
        padding: 1.2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s;
    }

    .btn-principal-nubeko:hover {
        background: var(--accent-dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(212, 165, 116, 0.3);
    }

    .btn-secundario-nubeko {
        text-align: center;
        color: var(--beige-500);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s;
    }

    .btn-secundario-nubeko:hover {
        color: var(--beige-800);
    }

    .msg-adoptado {
        background: var(--beige-100);
        color: var(--beige-600);
        padding: 1.2rem;
        border-radius: 50px;
        text-align: center;
        font-weight: 600;
    }

    .btn-favorito {
        margin-top: 10px;
        background: transparent;
        border: 2px solid #d4a574;
        color: #8b7355;
        padding: 0.8rem;
        border-radius: 50px;
        width: 100%;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-favorito:hover {
        background: #d4a574;
        color: white;
    }

    @media (max-width: 768px) {
        .card-detalle {
            grid-template-columns: 1fr;
        }

        .image-wrapper {
            min-height: 300px;
        }

        .detalle-body {
            padding: 2rem;
        }

        .animal-name {
            font-size: 2.5rem;
        }
    }
</style>
@endsection