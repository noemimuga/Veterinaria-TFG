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

        /* DARK MODE */

        .dark-mode {
            background: #2b2b2b;
            color: #f5f5f5;
        }

        /* HEADER */
        .dark-mode header {
            background: #3a3a3a;
            border-bottom: 1px solid #555;
        }

        /* NAV */
        .dark-mode .nav-links a,
        .dark-mode .logo {
            color: #f5f5f5;
        }

        /* TARJETAS */
        .dark-mode .card,
        .dark-mode .card-box,
        .dark-mode .filtros {
            background: #ffffff;
            color: #4a4a4a;
            border: 1px solid #555;
        }

        /* TEXTOS */
        .dark-mode h1,
        .dark-mode h2,
        .dark-mode h4,
        .dark-mode p,
        .dark-mode label,
        .dark-mode li {
            color: #ffffff !important;
        }

        .dark-mode .intro-p {
            color: #ffffff !important;
        }


        .dark-mode .tarjeta-blanca * {
            color: #4a4a4a !important;
        }

        .dark-mode .categories-grid h3 {
            color: #4a4a4a;
        }

        .dark-mode .card-body p {
            color: #4a4a4a !important;
        }

        .dark-mode .card .form-label,
        .black-mode .card .form-label {
            color: #1a1a1a !important;
        }

        .dark-mode .card .form-control,
        .dark-mode .card .form-select {
            color: #1a1a1a !important;
            background-color: #ffffff !important;
        }

        /* INPUTS */
        .dark-mode input,
        .dark-mode select {
            background: #4a4a4a;
            color: #ffffff;
            border: 1px solid #666;
        }

        /* FOOTER */
        .dark-mode footer {
            background: #1f1f1f;
        }

        .dark-mode .footer-section p,
        .dark-mode .footer-section a,
        .dark-mode .footer-bottom {
            color: #e0e0e0;
        }

        /* BOTONES */
        .dark-mode .btn-simple,
        .dark-mode .btn,
        .dark-mode .btn-primary {
            background: #d4a574;
            color: white;
        }

        /* ENLACES */
        .dark-mode a:hover {
            color: #f0d9b5;
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

        .card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .card:nth-child(6) {
            animation-delay: 0.6s;
        }
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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
            <a href="{{ route('home') }}" class="logo">Refugio Nubeko</a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="{{ route('adopta.index') }}">Adoptar</a></li>

                @auth
                @if(Auth::user()->esRefugio())
                <li><a href="{{ route('animales.create') }}">Publicar Animal</a></li>
                <li><a href="{{ route('refugio.dashboard') }}">Panel Refugio</a></li>
                @else
                <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
                @endif

                <li><a href="{{ url('/mi-cuenta') }}">Mi Cuenta</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-primary" style="border:none; cursor:pointer;">Cerrar sesión</button>
                    </form>
                </li>
                @else
                <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
                <li><a href="{{ route('login') }}" class="btn-primary">Iniciar Sesión</a></li>
                @endauth

                {{-- BOTÓN DARK MODE Y BANDERAS --}}
                <li><button class="btn-simple" onclick="toggleDarkMode()">🌙</button></li>
                <li><a href="/lang/es"><img src="{{ asset('img/flags/espana.png') }}" width="24" alt="Español"></a></li>
                <li><a href="/lang/en"><img src="{{ asset('img/flags/ing.png') }}" width="24" alt="English"></a></li>
            </ul>
        </nav>
    </header>

    <main>
        {{-- Mensaje de Éxito --}}
        @if(session('success'))
        <div style="background: rgba(34, 197, 94, 0.1); color: #15803d; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem; border-left: 4px solid #22c55e;">
            {{ session('success') }}
        </div>
        @endif

        {{-- Mensaje de Error de Validación --}}
        @if ($errors->any())
        <div style="background: rgba(239, 68, 68, 0.1); color: #b91c1c; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem; border-left: 4px solid #ef4444;">
            <ul style="margin: 0; padding: 0; list-style: none;">
                @foreach ($errors->all() as $error)
                <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Refugio Nubeko</h4>
                <p>Brindando segundas oportunidades a nuestros amigos peludos desde 2026</p>
            </div>
            <div class="footer-section">
                <h4>Enlaces</h4>
                <a href="{{ route('faq') }}">Preguntas Frecuentes</a>
                <a href="{{ route('proceso') }}">Proceso de Adopción</a>
                <a href="{{ route('voluntariado') }}">Voluntariado</a>
                <a href="{{ route('donaciones') }}">Donaciones</a>
                <a href="{{ route('privacidad') }}">Política de Privacidad</a>
                <a href="{{ route('legal') }}">Aviso Legal</a>

            </div>
            <div class="footer-section">
                <h4>Contacto</h4>
                <p>📍 Calle del Calvario, Madrid</p>
                <p>📞 +34 123 456 789</p>
                <p>✉️ info@refugionubeko.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Refugio Nubeko. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!--BANNER COOKIES -->
    <div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; width: 100%; background: #4a3d30;
    color: white; padding: 20px; text-align: center; z-index: 9999; display: none;">

        Usamos cookies para mejorar la experiencia y habilitar funciones como el chat.

        <br><br>

        <button onclick="aceptarCookies()">Aceptar</button>
        <button onclick="rechazarCookies()">Rechazar</button>
        <button onclick="mostrarPanel()">Configurar</button>
    </div>

    <!--PANEL CONFIGURACIÓN -->
    <div id="cookie-panel" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white;
    padding: 20px; z-index: 10000; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">

        <h3>Preferencias de cookies</h3>

        <label>
            <input type="checkbox" id="chatCookies"> Activar chat
        </label>

        <br><br>

        <button onclick="guardarPreferencias()">Guardar</button>
        <button onclick="cerrarTodo()">Cancelar</button>
    </div>
    @yield('extra-scripts')

    <script>
        const EXPIRACION_DIAS = 7;
        let chatCargado = false;

        /* 💬 CARGAR CHAT */
        function cargarChat() {
            if (chatCargado) return;
            chatCargado = true;

            const s1 = document.createElement("script");
            s1.src = "https://embed.tawk.to/69fb71d5ca8b551c36f24a66/1jnv39b4k";
            s1.async = true;
            document.body.appendChild(s1);
        }

        /* MOSTRAR / OCULTAR */
        function mostrarBanner() {
            document.getElementById("cookie-banner").style.display = "block";
        }

        function cerrarTodo() {
            document.getElementById("cookie-banner").style.display = "none";
            document.getElementById("cookie-panel").style.display = "none";
        }

        function mostrarPanel() {
            document.getElementById("cookie-panel").style.display = "block";
        }

        /* ACEPTAR */
        function aceptarCookies() {
            localStorage.setItem("cookiesAceptadas", "true");
            localStorage.setItem("chatCookies", "true");
            localStorage.setItem("cookieDate", Date.now());

            cerrarTodo();
            cargarChat();
        }

        /* RECHAZAR */
        function rechazarCookies() {
            localStorage.setItem("cookiesAceptadas", "false");
            localStorage.setItem("chatCookies", "false");
            localStorage.setItem("cookieDate", Date.now());

            cerrarTodo();
        }

        /* GUARDAR CONFIG */
        function guardarPreferencias() {
            const chat = document.getElementById("chatCookies").checked;

            localStorage.setItem("cookiesAceptadas", "true");
            localStorage.setItem("chatCookies", chat ? "true" : "false");
            localStorage.setItem("cookieDate", Date.now());

            cerrarTodo();

            if (chat) cargarChat();
        }

        /* INICIALIZACIÓN PROFESIONAL */
        document.addEventListener("DOMContentLoaded", function() {
            const decision = localStorage.getItem("cookiesAceptadas");
            const chat = localStorage.getItem("chatCookies");
            const last = localStorage.getItem("cookieDate");

            const ahora = Date.now();
            const expira = EXPIRACION_DIAS * 24 * 60 * 60 * 1000;

            const necesitaBanner = !last || (ahora - last > expira);

            if (necesitaBanner) {
                mostrarBanner();
                return;
            }

            cerrarTodo();

            if (chat === "true") {
                cargarChat();
            }
        });

        function toggleDarkMode() {

            document.body.classList.toggle("dark-mode");

        }
    </script>





</body>

</html>