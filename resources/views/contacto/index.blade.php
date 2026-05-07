@extends('layouts.app')

@section('title', 'Contacto y Nosotros - Refugio Nubeko')

@section('content')
<div class="container-contacto">

    <!-- SECCIÓN: QUIÉNES SOMOS -->
    <section class="nosotros-section">
        <div class="nosotros-grid">
            <div class="nosotros-image">
                <img src="https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?q=80&w=1000" alt="Nuestro equipo">
            </div>
            <div class="nosotros-text">
                <span class="subtitle">Nuestra Misión</span>
                <h2>Sobre Refugio Nubeko</h2>
                <p>Somos una organización dedicada al rescate y rehabilitación de animales en situación de abandono. Creemos firmemente que cada mascota merece una segunda oportunidad en un hogar lleno de amor.</p>
                <p>Desde nuestra fundación, hemos ayudado a cientos de peludos a encontrar su familia ideal, trabajando con transparencia y pasión por el bienestar animal.</p>

                <div class="stats">
                    <div class="stat-item">
                        <strong>500+</strong>
                        <span>Adopciones</span>
                    </div>
                    <div class="stat-item">
                        <strong>10+</strong>
                        <span>Años de labor</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="separator">

    <!-- SECCIÓN: CONTACTO -->
    <section class="contacto-section">
        <div class="contacto-grid">
            <div class="contacto-info">
                <h2>Ponte en contacto</h2>
                <p>¿Tienes dudas sobre el proceso de adopción o quieres colaborar con nosotros? Estamos aquí para ayudarte.</p>

                <div class="info-list">
                    <div class="info-item">
                        <span class="icon">📍</span>
                        <p><strong>Ubicación:</strong> Calle Ejemplo 123, Madrid, España</p>
                    </div>
                    <div class="info-item">
                        <span class="icon">📞</span>
                        <p><strong>Teléfono:</strong> +34 912 345 678</p>
                    </div>
                    <div class="info-item">
                        <span class="icon">✉️</span>
                        <p><strong>Email:</strong> hola@refugionubeko.com</p>
                    </div>
                </div>
            </div>

            <div class="contacto-form">
                <form action="#" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nombre completo</label>
                        <input type="text" name="nombre" placeholder="Tu nombre..." required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="tu@email.com" required>
                    </div>
                    <div class="form-group">
                        <label>Mensaje</label>
                        <textarea name="mensaje" rows="5" placeholder="¿En qué podemos ayudarte?" required></textarea>
                    </div>
                    <button type="submit" class="btn-enviar">Enviar Mensaje</button>
                </form>
            </div>
        </div>
        <!-- MAPA + UBICACIÓN -->
<div style="margin-top: 2rem;">

    <h3 style="margin-bottom: 1rem;">Cómo llegar</h3>

    {{-- Imagen del mapa (sin APIs, sin dependencias) --}}
     <iframe
        src="https://www.google.com/maps?q=C.+del+Calvario+Madrid&output=embed"
        width="100%"
        height="300"
        style="border:0; border-radius:15px;"
        allowfullscreen=""
        loading="lazy">
    </iframe>

    <p style="margin-top: 1rem;">
        <strong>Dirección:</strong> Calle del Calvario, Madrid, España
    </p>

    <p>
        <a href="https://www.google.com/maps?q=C.+del+Calvario+Madrid" target="_blank">
            Ver en Google Maps
        </a>
    </p>

</div>
    </section>
</div>

<style>
    .container-contacto {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem 0;
    }

    .separator {
        border: 0;
        height: 1px;
        background: var(--beige-200);
        margin: 4rem 0;
    }

    /* Estilos Nosotros */
    .nosotros-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .nosotros-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 15px 15px 0 var(--beige-100);
    }

    .subtitle {
        color: var(--accent);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }

    .nosotros-text h2 {
        font-family: 'Cormorant', serif;
        font-size: 3rem;
        color: var(--beige-800);
        margin: 0.5rem 0 1.5rem;
    }

    .stats {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
    }

    .stat-item strong {
        display: block;
        font-size: 1.8rem;
        color: var(--accent);
    }

    /* Estilos Formulario y Contacto */
    .contacto-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 4rem;
    }

    .contacto-info h2 {
        font-family: 'Cormorant', serif;
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
    }

    .info-list {
        margin-top: 2rem;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .contacto-form {
        background: white;
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: 0 10px 40px var(--shadow);
        border: 1px solid var(--beige-100);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--beige-700);
    }

    .form-group input, .form-group textarea {
        width: 100%;
        padding: 0.8rem;
        border: 1.5px solid var(--beige-200);
        border-radius: 10px;
        background: var(--beige-50);
        font-family: inherit;
    }

    .btn-enviar {
        width: 100%;
        padding: 1rem;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-enviar:hover {
        background: var(--accent-dark);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .nosotros-grid, .contacto-grid { grid-template-columns: 1fr; gap: 2rem; }
        .nosotros-text h2 { font-size: 2.2rem; }
    }
</style>
@endsection
