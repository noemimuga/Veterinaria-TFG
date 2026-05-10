@extends('layouts.app')

@section('content')

<div class="container-dinamico">

    <h1 class="titulo">{{ __('messages.login_title') }}</h1>

    <div class="card-box">

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <label>{{ __('messages.email') }}</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    style="padding:10px; margin-top:10px; margin-bottom:10px; width:100%;"
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
                    style="padding:10px; margin-top:10px; margin-bottom:10px; width:100%;"
                >

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember -->
            <div style="margin-top:15px;">
                <label>
                    <input type="checkbox" name="remember">
                    {{ __('messages.remember_me') }}
                </label>
            </div>

            <!-- Actions -->
            <div style="margin-top:20px; display:flex; justify-content:space-between; align-items:center;">

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('messages.forgot_password') }}
                    </a>
                @endif

                <button type="submit" class="btn-simple">
                    {{ __('messages.login') }}
                </button>

            </div>
        </form>

    </div>

</div>

@endsection
