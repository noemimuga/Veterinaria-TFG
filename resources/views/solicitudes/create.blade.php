@extends('layouts.app')

@section('content')
<main>
    <div class="card" style="max-width: 800px; margin: 0 auto; animation: fadeInUp 0.6s ease;">
        <div class="card-content">
            <h2 style="font-family: 'Cormorant', serif; font-size: 2.5rem; text-align: center; color: var(--beige-800); margin-bottom: 1rem;">
                Solicitud para adoptar a {{ $animal->nombre }}
            </h2>


            {{-- Mensajes de Error de Sesión (Duplicados, fallos de guardado) --}}
            @if (session('error'))
            <div style="background-color: #fee2e2; border: 1.5px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; text-align: center; animation: fadeIn 0.4s ease;">
                 {{ session('error') }}
            </div>
            @endif

            {{-- Mensajes de Validación (Campos vacíos, formato teléfono, etc) --}}
            @if ($errors->any())
            <div style="background-color: #fff7ed; border: 1.5px solid #f97316; color: #9a3412; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; animation: fadeIn 0.4s ease;">
                <ul style="margin: 0; padding-left: 1.2rem;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            <form action="{{ route('solicitudes.store', $animal->id) }}" method="POST" class="filtros" style="display: flex; flex-direction: column; gap: 1.5rem; background: transparent; border: none; box-shadow: none;">
                @csrf

                {{-- NOMBRE COMPLETO --}}
                <div style="width: 100%;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--beige-700);">Nombre Completo</label>
                    <input type="text" name="nombre_completo" value="{{ Auth::user()->name }}" required placeholder="Nombre y apellidos">
                </div>

                {{-- TELÉFONO --}}
                <div style="width: 100%;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--beige-700);">Teléfono de contacto</label>
                    <input type="text" name="telefono" required>
                </div>

                {{-- VIVIENDA --}}
                <div style="width: 100%;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--beige-700);">¿Cómo es tu vivienda?</label>
                    <textarea name="vivienda" required placeholder="Ej: Piso, casa con jardín..."
                        style="width: 100%; padding: 0.8rem 1.2rem; border: 1.5px solid var(--beige-300); border-radius: 10px; background: var(--beige-50); font-family: inherit; min-height: 100px;resize: none;"></textarea>
                </div>

                {{-- MOTIVO --}}
                <div style="width: 100%;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--beige-700);">¿Por qué quieres adoptar a {{ $animal->nombre }}?</label>
                    <textarea name="motivo" required placeholder="Cuéntanos un poco por qué encajaría contigo..."
                        style="width: 100%; padding: 0.8rem 1.2rem; border: 1.5px solid var(--beige-300); border-radius: 10px; background: var(--beige-50); font-family: inherit; min-height: 120px; resize: none;"></textarea>
                </div>

                {{-- BOTONES --}}
                <div style="width: 100%; text-align: center; margin-top: 2rem;">
                    <div style="margin-bottom: 1.5rem;">
                        <button type="submit" class="btn-primary"
                            style="border: none; cursor: pointer; padding: 1rem 3.5rem; font-size: 1.1rem; min-width: 250px;">
                            Enviar Solicitud
                        </button>
                    </div>

                    <div>
                        <a href="{{ route('animales.show', $animal->id) }}"
                            style="color: var(--beige-600); 
                                   text-decoration: underline !important; 
                                   text-underline-offset: 5px; 
                                   font-size: 0.95rem; 
                                   font-weight: 500;
                                   display: inline-block;">
                            Volver
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection