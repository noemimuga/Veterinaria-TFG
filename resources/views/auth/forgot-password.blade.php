@extends('layouts.app')

@section('content')

<div class="container-dinamico">

    <h1 class="titulo">{{ __('messages.forgot_password') }}</h1>

    <div class="card-box">

        <p style="margin-bottom:20px;">
            {{ __('messages.forgot_password_text') }}
        </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>

                <label>{{ __('messages.email') }}</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    style="width:100%; padding:10px; margin-top:10px; margin-bottom:10px;"
                >

                <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>

            <div style="display:flex; justify-content:end; margin-top:20px;">

                <button type="submit" class="btn-simple">
                    {{ __('messages.send_reset_link') }}
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
