@extends('layouts.app')

@section('title', $animal->nombre)

@section('content')

<div class="animal-container">

    <div class="animal-card">

        {{-- FOTO --}}
        <div class="animal-image">

            @if($animal->foto)
                <img src="{{ asset('storage/' . $animal->foto) }}" alt="{{ $animal->nombre }}">
            @else
                <img src="https://via.placeholder.com/500x400?text=Sin+Imagen" alt="Sin imagen">
            @endif

        </div>

        {{-- INFO --}}
        <div class="animal-info">

            <h1>{{ $animal->nombre }}</h1>

            <div class="badges">
                <span>{{ $animal->especie }}</span>
                <span>{{ $animal->raza }}</span>
                <span>{{ $animal->edad }} años</span>
            </div>

            <div class="estado">
                Estado:
                <strong>{{ ucfirst($animal->estado) }}</strong>
            </div>

            <div class="descripcion">
                <h3>Descripción</h3>

                <p>
                    {{ $animal->descripcion ?? 'Sin descripción disponible.' }}
                </p>
            </div>

            {{-- BOTONES REFUGIO --}}
            @if(auth()->check() && auth()->user()->esRefugio() && auth()->id() == $animal->refugio_id)

                <div class="acciones-refugio">

                    <a href="{{ route('animales.edit', $animal->id) }}" class="btn editar">
                        Editar
                    </a>

                    <form action="{{ route('animales.destroy', $animal->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="btn eliminar"
                            onclick="return confirm('¿Seguro que quieres eliminar este animal?')">

                            Eliminar

                        </button>

                    </form>

                </div>

            @endif

            {{-- SOLICITUD ADOPCIÓN --}}
            @auth

                @if(!auth()->user()->esRefugio())

                    @if($animal->estado === 'disponible')

                        <form action="{{ route('solicitudes.store', $animal->id) }}" method="POST">

                            @csrf

                            <button type="submit" class="btn adoptar">
                                Solicitar adopción
                            </button>

                        </form>

<<<<<<< HEAD
                    @else

                        <button class="btn deshabilitado" disabled>
                            No disponible
                        </button>

=======
    <div class="container-detalle">
        <div class="card-detalle">
            {{-- Sección de Imagen --}}
            <div class="detalle-header">
                <div class="image-wrapper">
                    @if($animal->foto)
                       <img src="{{ asset('img/' . $animal->foto) }}" alt="{{ $animal->nombre }}">
                        <div class="no-image-placeholder">🐾</div>
>>>>>>> 00718bdaca476c46d82296a6cba7478eb264b861
                    @endif

                @endif

            @else

                <a href="{{ route('login') }}" class="btn adoptar">
                    Inicia sesión para adoptar
                </a>

            @endauth

        </div>

    </div>

</div>

@endsection


@section('extra-styles')

<style>

.animal-container{
    max-width:1200px;
    margin:auto;
    padding:40px 20px;
}

.animal-card{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:40px;
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.animal-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.animal-info{
    padding:40px;
}

.animal-info h1{
    font-size:3rem;
    margin-bottom:20px;
    color:#8b7355;
}

.badges{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    margin-bottom:20px;
}

.badges span{
    background:#f4e9dc;
    color:#8b7355;
    padding:8px 14px;
    border-radius:20px;
    font-size:0.9rem;
}

.estado{
    margin-bottom:30px;
    font-size:1.1rem;
}

.descripcion h3{
    margin-bottom:10px;
    color:#8b7355;
}

.descripcion p{
    line-height:1.8;
    color:#555;
}

.acciones-refugio{
    display:flex;
    gap:15px;
    margin-top:30px;
}

.btn{
    display:inline-block;
    padding:12px 20px;
    border:none;
    border-radius:10px;
    text-decoration:none;
    cursor:pointer;
    transition:0.3s;
    font-size:1rem;
    text-align:center;
}

.editar{
    background:#d4a574;
    color:white;
}

.editar:hover{
    background:#b8865a;
}

.eliminar{
    background:#dc3545;
    color:white;
}

.eliminar:hover{
    background:#bb2d3b;
}

.adoptar{
    margin-top:30px;
    background:#28a745;
    color:white;
    width:100%;
}

.adoptar:hover{
    background:#218838;
}

.deshabilitado{
    margin-top:30px;
    width:100%;
    background:#999;
    color:white;
    cursor:not-allowed;
}

@media(max-width:768px){

    .animal-card{
        grid-template-columns:1fr;
    }

    .animal-info{
        padding:25px;
    }

    .animal-info h1{
        font-size:2rem;
    }

    .acciones-refugio{
        flex-direction:column;
    }

}

</style>

@endsection
