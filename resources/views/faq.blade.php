@extends('layouts.app')

@section('content')
<div class="container-dinamico">
    <h1 class="titulo">Preguntas Frecuentes</h1>

    <div class="card-box" onclick="toggleFaq(1)">
        <h3>¿Cómo adoptar?</h3>
        <p id="faq1" class="hidden">Registrarte, elegir animal y enviar solicitud.</p>
    </div>

    <div class="card-box" onclick="toggleFaq(2)">
        <h3>¿Tiene coste?</h3>
        <p id="faq2" class="hidden">Sí, para cubrir gastos veterinarios.</p>
    </div>

    <div class="card-box" onclick="toggleFaq(3)">
        <h3>¿Puedo visitarlo?</h3>
        <p id="faq3" class="hidden">Sí, con cita previa.</p>
    </div>
</div>

<script>
function toggleFaq(id) {
    let el = document.getElementById("faq" + id);
    el.classList.toggle("hidden");
}
</script>
@endsection
