@extends('layouts.app')

@section('content')

<div class="container-dinamico">

    <h1 class="titulo">Confirmar contraseña</h1>

    <div class="card-box">

        <p style="margin-bottom:20px;">
            Esta es una zona segura de la aplicación. Confirma tu contraseña antes de continuar.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <label>Contraseña</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    style="width:100%; padding:10px; margin-top:10px; margin-bottom:10px;"
                >

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Botón -->
            <div style="display:flex; justify-content:flex-end; margin-top:20px;">
                <button type="submit" class="btn-simple">
                    Confirmar
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
