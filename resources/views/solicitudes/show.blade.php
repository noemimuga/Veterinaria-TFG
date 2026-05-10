@extends('layouts.app')

@section('title', 'Detalle de Solicitud')

@section('content')
<div class="container">
    <h1>Solicitud de {{ $solicitud->animal->nombre }}</h1>

    <p><strong>Solicitante:</strong> {{ $solicitud->user->name }} ({{ $solicitud->user->email }})</p>
    <p><strong>Animal:</strong> {{ $solicitud->animal->nombre }} - {{ $solicitud->animal->raza }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($solicitud->estado) }}</p>

    @if(Auth::user()->esRefugio() && $solicitud->estado == 'pendiente')
        <form action="{{ route('solicitudes.aceptar', $solicitud->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button class="btn btn-success">Aceptar</button>
        </form>

        <form action="{{ route('solicitudes.rechazar', $solicitud->id) }}" method="POST" style="margin-top: 10px;">
            @csrf
            @method('PATCH')
            <button class="btn btn-danger">Rechazar</button>
        </form>
    @endif
</div>
@endsection
