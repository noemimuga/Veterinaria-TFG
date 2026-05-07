@extends('layouts.app')

@section('content')
<div class="container-dinamico">
    <h1 class="titulo">Donaciones</h1>

    <p>Tu ayuda es fundamental para seguir cuidando a nuestros animales 🐾</p>

    <div class="card-box">
        <label>Cantidad (€):</label>
        <input type="number" id="cantidad" placeholder="Ej: 10" style="width:100%; padding:10px; margin-top:10px;  margin-bottom:10px;">

         <!-- BOTONES RÁPIDOS -->
        <div style="display:flex; gap:10px; margin-bottom:15px;">
            <button class="btn-simple" onclick="setCantidad(5)">5€</button>
            <button class="btn-simple" onclick="setCantidad(10)">10€</button>
            <button class="btn-simple" onclick="setCantidad(20)">20€</button>
        </div>

        <!--BOTÓN DONAR-->
        <button class="btn-simple" onclick="donar()">Donar</button>
    </div>

    <p id="mensaje" class="hidden"></p>
</div>



<script>
function setCantidad(valor) {
    document.getElementById("cantidad").value = valor;
}

function donar() {

    let cantidad = document.getElementById("cantidad").value;
    let mensaje = document.getElementById("mensaje");

    if (cantidad === "" || cantidad <= 0) {

        mensaje.innerHTML = "Introduce una cantidad válida";

    } else {

        mensaje.innerHTML = "❤️ Gracias por tu donación de " + cantidad + "€";

    }

    mensaje.classList.remove("hidden");
}
</script>
@endsection
