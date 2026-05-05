@extends('layouts.app')

@section('content')
<div class="container-dinamico">
    <h1 class="titulo">Voluntariado</h1>

    <p>Ayuda a los animales siendo voluntario.</p>

    <button class="btn-simple" onclick="verOpciones()">Ver opciones</button>

    <ul id="lista" class="hidden">
        <li>Pasear perros</li>
        <li>Cuidar gatos</li>
        <li>Eventos</li>
    </ul>
</div>

<script>
function verOpciones() {
    document.getElementById("lista").classList.toggle("hidden");
}
</script>
@endsection
