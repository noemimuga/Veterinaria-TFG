@extends('layouts.app')

@section('title', 'Panel del Refugio - Nubeko')

@section('content')
<div class="contenedor-panel">
    <h1 class="titulo-panel">Panel de Administración</h1>

    {{-- Estadísticas --}}
    <div class="estadisticas">
        <div class="tarjeta-estadistica pendiente">
            <h3>{{ $pendientes }}</h3>
            <p>Pendientes</p>
        </div>
        <div class="tarjeta-estadistica aceptada">
            <h3>{{ $aceptadas }}</h3>
            <p>Aceptadas</p>
        </div>
        <div class="tarjeta-estadistica rechazada">
            <h3>{{ $rechazadas }}</h3>
            <p>Rechazadas</p>
        </div>
    </div>

    <h2 class="subtitulo-panel">Solicitudes de Adopción</h2>

    {{-- Tabs de filtrado --}}
    <div class="tabs-filtro">
        <button class="tab-boton activo" onclick="filtrarPor('todas')">Todas ({{ $solicitudes->count() }})</button>
        <button class="tab-boton" onclick="filtrarPor('pendiente')">Pendientes ({{ $pendientes }})</button>
        <button class="tab-boton" onclick="filtrarPor('aceptada')">Aceptadas ({{ $aceptadas }})</button>
        <button class="tab-boton" onclick="filtrarPor('rechazada')">Rechazadas ({{ $rechazadas }})</button>
    </div>

    {{-- Lista de solicitudes --}}
    <div class="lista-solicitudes">
        @forelse($solicitudes as $solicitud)
        <div class="tarjeta-solicitud" data-estado="{{ $solicitud->estado }}">
            <div class="encabezado-solicitud">
                <div class="info-basica">
                    <img src="{{ asset('storage/' . $solicitud->animal->foto) }}"
                        alt="{{ $solicitud->animal->nombre }}"
                        class="foto-mini">
                    <div>
                        <h3>{{ $solicitud->animal->nombre }}</h3>
                        <p class="texto-secundario">{{ $solicitud->animal->raza }} - {{ $solicitud->animal->edad }} años</p>
                    </div>
                </div>
                <span class="etiqueta-estado {{ $solicitud->estado }}">
                    @if($solicitud->estado === 'pendiente') Pendiente
                    @elseif($solicitud->estado === 'aceptada') Aceptada
                    @else Rechazada
                    @endif
                </span>
            </div>

            <div class="cuerpo-solicitud">
                <div class="fila-info">
                    <div class="columna-info">
                        <strong>Solicitante:</strong>
                        <p>{{ $solicitud->nombre_completo }}</p>
                    </div>
                    <div class="columna-info">
                        <strong>Email:</strong>
                        <p>{{ $solicitud->email }}</p>
                    </div>
                    <div class="columna-info">
                        <strong>Teléfono:</strong>
                        <p>{{ $solicitud->datos_contacto }}</p>
                    </div>
                </div>


                <div class="info-detalle">
                    <strong>Motivo de adopción:</strong>
                    <p>{{ $solicitud->motivo }}</p>
                </div>

                @if($solicitud->estado === 'rechazada' && $solicitud->mensaje_rechazo)
                <div class="mensaje-rechazo">
                    <strong>Motivo del rechazo:</strong>
                    <p>{{ $solicitud->mensaje_rechazo }}</p>
                </div>
                @endif

                <p class="fecha-solicitud"> Solicitado el {{ $solicitud->created_at->format('d/m/Y H:i') }}</p>
            </div>

            {{-- Botones de acción solo para pendientes --}}
            @if($solicitud->estado === 'pendiente')
            <div class="acciones-solicitud">
                <form method="POST" action="{{ route('solicitudes.aceptar', $solicitud->id) }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="boton-aceptar" onclick="return confirm('¿Aceptar esta solicitud?')">
                        Aceptar
                    </button>
                </form>

                <form action="{{ route('solicitudes.rechazar', $solicitud->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="boton-rechazar" type="submit" class="btn-rechazar" onclick="return confirm('¿Estás seguro de que quieres rechazar esta solicitud?')">
                        Rechazar
                    </button>
                </form>
            </div>
            @endif
        </div>
        @empty
        <div class="sin-solicitudes">
            <p>No hay solicitudes registradas</p>
        </div>
        @endforelse
    </div>
</div>


<style>
    .contenedor-panel {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .titulo-panel {
        font-family: 'Cormorant', serif;
        font-size: 2.5rem;
        color: var(--beige-800);
        margin-bottom: 2rem;
        text-align: center;
    }

    /* ESTADÍSTICAS */
    .estadisticas {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .tarjeta-estadistica {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 15px var(--shadow);
        border-left: 5px solid;
    }

    .tarjeta-estadistica.pendiente {
        border-left-color: #f59e0b;
    }

    .tarjeta-estadistica.aceptada {
        border-left-color: #10b981;
    }

    .tarjeta-estadistica.rechazada {
        border-left-color: #ef4444;
    }

    .tarjeta-estadistica h3 {
        font-size: 3rem;
        font-weight: 700;
        margin: 0;
    }

    .tarjeta-estadistica p {
        margin: 0.5rem 0 0 0;
        color: var(--beige-600);
    }

    /* TABS */
    .subtitulo-panel {
        font-family: 'Cormorant', serif;
        font-size: 2rem;
        color: var(--beige-800);
        margin-bottom: 1rem;
    }

    .tabs-filtro {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .tab-boton {
        padding: 0.7rem 1.5rem;
        background: white;
        border: 2px solid var(--beige-300);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 500;
    }

    .tab-boton.activo {
        background: var(--accent);
        color: white;
        border-color: var(--accent);
    }

    .tab-boton:hover {
        border-color: var(--accent);
    }

    /* SOLICITUDES */
    .lista-solicitudes {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .tarjeta-solicitud {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px var(--shadow);
        border: 1px solid var(--beige-200);
        transition: all 0.3s;
    }

    .tarjeta-solicitud:hover {
        box-shadow: 0 8px 25px var(--shadow-hover);
    }

    .encabezado-solicitud {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--beige-100);
    }

    .info-basica {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .foto-mini {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
    }

    .texto-secundario {
        color: var(--beige-600);
        font-size: 0.9rem;
        margin: 0;
    }

    .etiqueta-estado {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .etiqueta-estado.pendiente {
        background: #fef3c7;
        color: #92400e;
    }

    .etiqueta-estado.aceptada {
        background: #d1fae5;
        color: #065f46;
    }

    .etiqueta-estado.rechazada {
        background: #fee2e2;
        color: #991b1b;
    }

    /* CUERPO */
    .cuerpo-solicitud {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .fila-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .columna-info strong {
        display: block;
        color: var(--beige-700);
        margin-bottom: 0.3rem;
    }

    .columna-info p {
        margin: 0;
        color: var(--beige-800);
    }

    .info-detalle {
        margin-top: 0.5rem;
    }

    .info-detalle strong {
        display: block;
        color: var(--beige-700);
        margin-bottom: 0.3rem;
    }

    .info-detalle p {
        margin: 0;
        color: var(--beige-800);
        line-height: 1.6;
    }

    .mensaje-rechazo {
        background: #fee2e2;
        padding: 1rem;
        border-radius: 10px;
        border-left: 4px solid #ef4444;
    }

    .fecha-solicitud {
        color: var(--beige-500);
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    /* ACCIONES */
    .acciones-solicitud {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 2px solid var(--beige-100);
    }

    .boton-aceptar,
    .boton-rechazar {
        flex: 1;
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .boton-aceptar {
        background: #10b981;
        color: white;
    }

    .boton-aceptar:hover {
        background: #059669;
        transform: translateY(-2px);
    }

    .boton-rechazar {
        background: #ef4444;
        color: white;
    }

    .boton-rechazar:hover {
        background: #dc2626;
        transform: translateY(-2px);
    }

    /* MODAL */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-contenido {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    .modal-contenido h3 {
        font-family: 'Cormorant', serif;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: var(--beige-800);
    }

    .botones-modal {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .boton-confirmar,
    .boton-cancelar {
        flex: 1;
        padding: 0.8rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .boton-confirmar {
        background: #ef4444;
        color: white;
    }

    .boton-confirmar:hover {
        background: #dc2626;
    }

    .boton-cancelar {
        background: var(--beige-200);
        color: var(--beige-700);
    }

    .boton-cancelar:hover {
        background: var(--beige-300);
    }

    .sin-solicitudes {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--beige-500);
    }

    /* DARK MODE */
    .dark-mode .tarjeta-estadistica,
    .dark-mode .tarjeta-solicitud,
    .dark-mode .modal-contenido {
        background: #2d2d2d;
        border-color: #555;
    }

    .dark-mode .titulo-panel,
    .dark-mode .subtitulo-panel,
    .dark-mode .modal-contenido h3 {
        color: #f5e6d3;
    }

    .dark-mode .tab-boton {
        background: #3a3a3a;
        border-color: #555;
        color: #f5e6d3;
    }

    .dark-mode .tab-boton.activo {
        background: var(--accent);
        color: white;
    }

    .dark-mode .columna-info strong,
    .dark-mode .info-detalle strong {
        color: #f5e6d3;
    }

    .dark-mode .columna-info p,
    .dark-mode .info-detalle p {
        color: #f5e6d3;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .encabezado-solicitud {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .fila-info {
            grid-template-columns: 1fr;
        }

        .tabs-filtro {
            flex-direction: column;
        }
    }
</style>

<script>
    function filtrarPor(estado) {
        const solicitudes = document.querySelectorAll('.tarjeta-solicitud');
        const botones = document.querySelectorAll('.tab-boton');

        // Actualizar botones activos
        botones.forEach(btn => btn.classList.remove('activo'));
        event.target.classList.add('activo');

        // Filtrar solicitudes
        solicitudes.forEach(solicitud => {
            if (estado === 'todas') {
                solicitud.style.display = 'block';
            } else {
                solicitud.style.display = solicitud.dataset.estado === estado ? 'block' : 'none';
            }
        });
    }
</script>
@endsection