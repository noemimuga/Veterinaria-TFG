@extends('layouts.app')

@section('content')

<div class="container-dinamico">

    <h1 class="titulo">Nueva contraseña</h1>

    <div class="card-box">

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div>
                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    style="width:100%; padding:10px; margin-top:10px; margin-bottom:10px;"
                >

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label>Nueva contraseña</label>

                <input
                    type="password"
                    name="password"
                    required
                    style="width:100%; padding:10px; margin-top:10px; margin-bottom:10px;"
                >

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm -->
            <div class="mt-4">
                <label>Confirmar contraseña</label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    style="width:100%; padding:10px; margin-top:10px; margin-bottom:10px;"
                >

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Botón -->
            <div style="display:flex; justify-content:flex-end; margin-top:20px;">
                <button type="submit" class="btn-simple">
                    Cambiar contraseña
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
