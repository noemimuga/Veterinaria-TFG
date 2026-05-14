@extends('layouts.app')

@section('title', 'Contacto y Nosotras - Refugio Nubeko')

@section('content')
<div class="container-contacto">

    <!-- SECCIÓN: QUIÉNES SOMOS -->
    <section class="sobre-nosotros" style="max-width: 1000px; margin: 0 auto; padding: 4rem 2rem;">

        {{-- Introducción Personal --}}
        <div style="text-align: center; margin-bottom: 4rem;">
            <h2 style="font-family: 'Cormorant', serif; font-size: 3rem; color: var(--beige-800); margin-bottom: 1.5rem;">Nuestra Historia</h2>
            <p class="intro-p" style="font-size: 1.2rem; color: var(--beige-700); line-height: 1.8; max-width: 800px; margin: 0 auto;">
                Somos dos compañeras a las que les apasionan los animales y que decidimos unirnos para ayudarles a encontrar un hogar donde sean felices.
                Este proyecto nace del amor y del compromiso con los animales sin hogar.
</p>
        </div>
        <div><img src="{{ asset('img/imagenContacto.jpg') }}" alt="Gato y perro" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 15px; margin-bottom: 2rem;"></div>

  
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">

       
            <div class="tarjeta-blanca" style="background: var(--beige-50); padding: 2rem; border-radius: 15px; border-bottom: 3px solid var(--beige-300);">
                <h3 style="color: var(--beige-800); margin-bottom: 1rem;text-align:center">Adopción</h3>
                <p >No compres, adopta. Ese es nuestro lema. Miles de animales son abandonados cada año en España y estamos aquí para cambiar esa cifra.</p>
            </div>
           
            <div class="tarjeta-blanca" style="background: var(--beige-50); padding: 2rem; border-radius: 15px; border-bottom: 3px solid var(--beige-300);">
                <h3 style="color: var(--beige-800); margin-bottom: 1rem; text-align:center">Amor</h3>
                <p >Nuestro amor por los animales mueve este proyecto. Queremos que cada perro y gato abandonado encuentre el calor de una familia.</p>
            </div>
       
            <div class="tarjeta-blanca" style="background: var(--beige-50); padding: 2rem; border-radius: 15px; border-bottom: 3px solid var(--beige-300);">
                <h3 style="color: var(--beige-800); margin-bottom: 1rem; text-align:center">Esterilización</h3>
                <p >Fomentamos la adopción responsable, la esterilización y el cuidado veterinario para mejorar la vida de los animales y evitar abandonos.</p>
            </div>

        
            <div class="tarjeta-blanca" style="background: var(--beige-50); padding: 2rem; border-radius: 15px; border-bottom: 3px solid var(--beige-300);">
                <h3 style="color: var(--beige-800); margin-bottom: 1rem;text-align:center">Abuelitos</h3>
                <p >También queremos recordar que los animales mayores merecen la misma oportunidad de ser adoptados. A veces los más especiales son los que más han esperado.</p>
            </div>

        </div>
    </section>

    <hr class="separator">

    <!-- SECCIÓN: CONTACTO -->
   <section class="contacto-section">
        <div class="contacto-grid">
            <div class="contacto-info">
                <h2>Ponte en contacto</h2>
                <p>¿Tienes dudas sobre el proceso de adopción o quieres colaborar con nosotras? Estamos aquí para ayudarte.</p>

                <div class="info-list">
                    <div class="info-item">
                        <span class="icon">📍</span>
                        <p><strong>Ubicación:</strong> Calle del Calvario, Madrid</p>
                    </div>
                    <div class="info-item">
                        <span class="icon">📞</span>
                        <p><strong>Teléfono:</strong> +34 666 888 666</p>
                    </div>
                    <div class="info-item">
                        <span class="icon">✉️</span>
                        <p><strong>Email:</strong> info@refugionubeko.com</p>
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
    </section>
                    <!-- MAPA + UBICACIÓN -->
                    <div style="margin-top: 2rem;">

                        <h3 style="margin-bottom: 1rem;">Cómo llegar</h3>

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

    .form-group input,
    .form-group textarea {
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

        .nosotros-grid,
        .contacto-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .nosotros-text h2 {
            font-size: 2.2rem;
        }
    }
</style>
@endsection