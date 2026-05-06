<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Refugio de Adopciones')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@300;400;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --beige-50: #faf8f5;
            --beige-100: #f5f1ea;
            --beige-200: #ebe4d7;
            --beige-300: #d9cdb8;
            --beige-400: #c4b29a;
            --beige-500: #a68968;
            --beige-600: #8b7355;
            --beige-700: #6b5744;
            --beige-800: #4a3d30;
            --accent: #d4a574;
            --accent-dark: #b8865a;
            --white: #ffffff;
            --shadow: rgba(107, 87, 68, 0.08);
            --shadow-hover: rgba(107, 87, 68, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: var(--beige-50);
            color: var(--beige-800);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* HEADER */
        header {
            background: linear-gradient(135deg, var(--beige-100) 0%, var(--white) 100%);
            padding: 1.5rem 2rem;
            box-shadow: 0 2px 20px var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--beige-200);
        }

        nav {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Cormorant', serif;
            font-size: 2rem;
            font-weight: 600;
            color: var(--beige-700);
            text-decoration: none;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        .logo:hover {
            color: var(--accent-dark);
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            color: var(--beige-700);
            text-decoration: none;
            font-weight: 400;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--accent-dark);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links .btn-primary {
            background: var(--accent);
            color: var(--white);
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-links .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 165, 116, 0.3);
        }

        .nav-links .btn-primary::after {
            display: none;
        }

        /* MAIN CONTENT */
        main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3rem 2rem;
            min-height: calc(100vh - 250px);
        }

        /* FILTROS */
        .filtros {
            background: var(--white);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px var(--shadow);
            margin-bottom: 3rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
            border: 1px solid var(--beige-200);
        }

        .filtros input,
        .filtros select {
            padding: 0.8rem 1.2rem;
            border: 1.5px solid var(--beige-300);
            border-radius: 10px;
            font-family: 'Lato', sans-serif;
            font-size: 0.95rem;
            color: var(--beige-800);
            background: var(--beige-50);
            transition: all 0.3s ease;
            flex: 1;
            min-width: 150px;
        }

        .filtros input:focus,
        .filtros select:focus {
            outline: none;
            border-color: var(--accent);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
        }

        .filtros input::placeholder {
            color: var(--beige-400);
        }

        .filtros button {
            padding: 0.8rem 2rem;
            background: var(--beige-700);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .filtros button:hover {
            background: var(--beige-800);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px var(--shadow-hover);
        }

        .btn-reset {
            padding: 0.8rem 1.5rem;
            background: transparent;
            color: var(--beige-600);
            border: 1.5px solid var(--beige-300);
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-reset:hover {
            background: var(--beige-100);
            border-color: var(--beige-400);
            color: var(--beige-700);
        }

        /* GRID DE ANIMALES */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .card {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--beige-200);
            position: relative;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px var(--shadow-hover);
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card-content {
            padding: 1.5rem;
        }

        .card h3 {
            font-family: 'Cormorant', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--beige-800);
            margin-bottom: 0.5rem;
        }

        .card p {
            color: var(--beige-600);
            margin-bottom: 0.4rem;
            font-size: 0.95rem;
        }

        .card p strong {
            color: var(--beige-700);
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .badge-success {
            background: rgba(168, 137, 104, 0.15);
            color: var(--beige-700);
        }

        .badge-secondary {
            background: var(--beige-200);
            color: var(--beige-600);
        }

        .card .btn {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.7rem 1.8rem;
            background: var(--accent);
            color: var(--white);
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .card .btn:hover {
            background: var(--accent-dark);
            transform: translateX(5px);
        }

        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--beige-500);
            font-size: 1.1rem;
            grid-column: 1 / -1;
        }

        /* FOOTER */
        footer {
            background: linear-gradient(135deg, var(--beige-700) 0%, var(--beige-800) 100%);
            color: var(--beige-100);
            padding: 3rem 2rem 1.5rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            font-family: 'Cormorant', serif;
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: var(--accent);
        }

        .footer-section p,
        .footer-section a {
            color: var(--beige-200);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--accent);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(235, 228, 215, 0.2);
            color: var(--beige-300);
            font-size: 0.9rem;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .nav-links {
                gap: 1rem;
            }

            .logo {
                font-size: 1.5rem;
            }

            .filtros {
                flex-direction: column;
            }

            .filtros input,
            .filtros select {
                width: 100%;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }

        /* ANIMACIONES */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease backwards;
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }
    </style>

    @yield('extra-styles')
    <style>
.container-dinamico {
    max-width: 900px;
    margin: auto;
    padding: 2rem;
}

.titulo {
    text-align: center;
    margin-bottom: 2rem;
}

/* TARJETAS */
.card-box {
    background: white;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    cursor: pointer;
    transition: 0.3s;
}

.card-box:hover {
    transform: translateY(-3px);
}

/* CONTENIDO OCULTO */
.hidden {
    display: none;
}

/* PASOS */
.step {
    background: #f5f1ea;
    padding: 1rem;
    margin-bottom: 1rem;
    border-left: 5px solid #d4a574;
    border-radius: 8px;
}

/* BOTONES */
.btn-simple {
    background: #d4a574;
    color: white;
    padding: 0.6rem 1.2rem;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}

.center {
    text-align: center;
}
</style>
</head>
<body>
    <header>
        <nav>
    <!-- Logo: Ahora apunta a la home (el inicio real) -->
    <a href="{{ route('home') }}" class="logo">Refugio Nubeko</a>

    <ul class="nav-links">
        <!-- Inicio: Apunta a la página principal con estilo Kerubi -->
        <li><a href="{{ route('home') }}">Inicio</a></li>
        <li><a href="{{ route('adopta.index') }}">Adoptar</a></li>
        <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
        @auth
            @if(Auth::user()->esRefugio())
                <li><a href="{{ route('animales.create') }}" class="btn-primary">Publicar Animal</a></li>
            @endif
            <li><a href="{{ url('/profile') }}">Mi Cuenta</a></li>
        @else
            <li><a href="{{ route('login') }}" class="btn-primary">Iniciar Sesión</a></li>
        @endauth
    </ul>
</nav>
    </header>

    <main>
        @if(session('success'))
            <div style="background: rgba(168, 137, 104, 0.15); color: var(--beige-700); padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem; border-left: 4px solid var(--accent);">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Refugio Nubeko</h4>
                <p>Brindando segundas oportunidades a nuestros amigos peludos desde 2024</p>
            </div>
            <div class="footer-section">
                <h4>Contacto</h4>
                <p>📍 Calle del Calvario, Madrid</p>
                <p>📞 +34 912 345 678</p>
                <p>✉️ info@refugionubeko.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Refugio Nubeko. Todos los derechos reservados.</p>
        </div>
    </footer>

    @yield('extra-scripts')
</body>
</html>
