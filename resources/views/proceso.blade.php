@extends('layouts.app')

@section('content')
<div class="container-dinamico">
    <h1 class="titulo">Proceso de Adopción</h1>

    <div class="step">1. Explorar</div>
    <div class="step">2. Solicitar</div>
    <div class="step">3. Revisión</div>
    <div class="step">4. Contacto</div>
    <div class="step">5. Adopción</div>

    <div class="center">
        <button class="btn-simple" onclick="mostrarMensaje()">¿Listo para adoptar?</button>
        <p id="mensaje" class="hidden">¡Genial! Ve a la sección Adoptar 🐾</p>
    </div>
</div>

<script>
function mostrarMensaje() {
    document.getElementById("mensaje").classList.remove("hidden");
}
</script>
@endsection
