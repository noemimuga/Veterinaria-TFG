@extends('layouts.app')

@section('content')

<h1>Editar animal</h1>

<form action="{{ route('animales.update', $animal->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nombre" value="{{ $animal->nombre }}">

    <input type="text" name="especie" value="{{ $animal->especie }}">

    <input type="text" name="raza" value="{{ $animal->raza }}">

    <input type="number" name="edad" value="{{ $animal->edad }}">

    <textarea name="descripcion">{{ $animal->descripcion }}</textarea>

    <button type="submit">Actualizar</button>
</form>

@endsection
