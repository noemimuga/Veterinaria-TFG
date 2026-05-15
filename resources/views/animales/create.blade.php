@extends('layouts.app')

@section('title', 'Añadir animal')

@section('content')

<div class="create-container">

    <h1 class="title">Añadir nuevo animal</h1>

    <div class="form-card">

        <form action="{{ route('animales.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- NOMBRE --}}
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            {{-- ESPECIE --}}
            <div class="form-group">
                <label>Especie</label>
                <select name="especie" required>
                    <option value="">Selecciona</option>
                    <option value="perro">Perro</option>
                    <option value="gato">Gato</option>
                </select>
            </div>

            {{-- RAZA --}}
            <div class="form-group">
                <label>Raza</label>
                <input type="text" name="raza" value="{{ old('raza') }}">
            </div>

            {{-- EDAD --}}
            <div class="form-group">
                <label>Edad (años)</label>
                <input type="number" name="edad" min="0" value="{{ old('edad') }}">
            </div>

            {{-- DESCRIPCIÓN --}}
            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
            </div>

            {{-- SEXO --}}
            <div class="form-group">
                <label>Sexo</label>
                <select name="sexo" required>
                    <option value="">Selecciona</option>
                    <option value="hembra">Hembra</option>
                    <option value="macho">Macho</option>
                </select>
            </div>

            {{-- FOTO --}}
            <div class="form-group">
                <label>Foto del animal</label>
                <input type="file" name="foto" id="fotoInput">
                <img id="preview" class="preview" style="display:none;">
            </div>

            {{-- BOTÓN --}}
            <button type="submit" class="btn">
                Guardar animal
            </button>

        </form>

    </div>

</div>

@endsection


@section('extra-styles')

<style>

.create-container{
    max-width:700px;
    margin:auto;
    padding:40px 20px;
}

.title{
    text-align:center;
    margin-bottom:30px;
    color:#8b7355;
    font-size:2.2rem;
}

.form-card{
    background:white;
    padding:2rem;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.form-group{
    margin-bottom:15px;
}

label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
    color:#555;
}

input, select, textarea{
    width:100%;
    padding:10px;
    border-radius:8px;
    border:1px solid #ddd;
    outline:none;
}

input:focus, select:focus, textarea:focus{
    border-color:#d4a574;
}

.btn{
    width:100%;
    padding:12px;
    background:#d4a574;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
    margin-top:10px;
}

.btn:hover{
    background:#b8865a;
}

.preview{
    margin-top:10px;
    width:100%;
    max-height:250px;
    object-fit:cover;
    border-radius:10px;
}

/* responsive */
@media(max-width:600px){
    .form-card{
        padding:1.5rem;
    }
}

</style>

@endsection


@section('scripts')

<script>
document.getElementById('fotoInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    const preview = document.getElementById('preview');

    if(file){
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>

@endsection
