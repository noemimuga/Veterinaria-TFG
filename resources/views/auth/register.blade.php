@extends('layouts.app')

@section('content')

<div class="container-dinamico">

    <h1 class="titulo">{{ __('messages.register_title') }}</h1>

    <div class="card-box">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div>
                <label>{{ __('messages.name') }}</label>

                <input
                    type="text"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                    autofocus
                    style="width:100%; padding:10px; margin-top:10px; margin-bottom:10px;"
                >

                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <label>{{ __('messages.email') }}</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    style="width:100%; padding:10px; margin-top:10px; margin-bottom:10px;"
                >

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label>{{ __('messages.password') }}</label>

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
                <label>{{ __('messages.confirm_password') }}</label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    style="width:100%; padding:10px; margin-top:10px; margin-bottom:10px;"
                >

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Botones -->
            <div style="margin-top:20px; display:flex; justify-content:space-between; align-items:center;">

                <a href="{{ route('login') }}">
                    {{ __('messages.already_account') }}
                </a>

                <button type="submit" class="btn-simple">
                    {{ __('messages.register') }}
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
