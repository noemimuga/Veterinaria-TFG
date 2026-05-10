@extends('layouts.app')

@section('content')

<div class="container-dinamico">

    <h1 class="titulo">Verifica tu email</h1>

    <div class="card-box">

        <p style="margin-bottom:20px;">
            Gracias por registrarte. Antes de empezar, por favor verifica tu correo electrónico haciendo clic en el enlace que te hemos enviado.
        </p>

        @if (session('status') == 'verification-link-sent')
            <p style="color:green; margin-bottom:20px;">
                Se ha enviado un nuevo enlace de verificación a tu correo.
            </p>
        @endif

        <div style="display:flex; justify-content:space-between; align-items:center;">

            <!-- Reenviar email -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit" class="btn-simple">
                    Reenviar email
                </button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn-simple">
                    Cerrar sesión
                </button>
            </form>

        </div>

    </div>

</div>

@endsection
