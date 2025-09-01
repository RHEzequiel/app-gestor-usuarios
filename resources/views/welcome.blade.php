<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gestión de Alumnos</title>

        <link rel="icon" href="/logo_utn.png" sizes="any">
        <link rel="icon" href="/logo_utn.png" type="image/png+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <style>
            /* Reset básico */
            *, *::before, *::after {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            body {
                font-family: 'instrument-sans', sans-serif;
                background: #111827;
                color: #f1f5f9;
                min-height: 100vh;
                margin: 0;
                display: flex;
                flex-direction: column;
                position: relative;
                overflow-x: hidden;
            }
            
            /* Video de fondo */
            #background-video {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: -10;
            }
            
            /* Overlay para mejorar la legibilidad del texto */
            .video-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                z-index: 0;
                pointer-events: none;
            }
            .container {
                width: 100%;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem;
                position: relative;
                z-index: 1;
            }
            .top-header {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #8b0000 0%, #2c1a1a 100%);
                color: white;
                text-align: center;
                padding: 2rem;
                z-index: 5;
            }
            .top-header h1 {
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.75rem;
            }
            .top-header p {
                font-size: 1rem;
                opacity: 0.9;
            }
            .nav {
                position: absolute;
                top: 2rem;
                right: 1.5rem;
                display: flex;
                gap: 1rem;
                z-index: 10;
            }
            .nav-link {
                color: white;
                text-decoration: none;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                font-weight: 500;
                transition: all 0.3s;
                background-color: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.2);
                text-decoration: none;
            }
            .welcome-card {
                background-color: white;
                border-radius: 1.5rem;
                padding: 1.5rem;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                max-width: 480px;
                width: 100%;
                color: #1a202c;
                margin-top: 5rem;
                margin-left: auto;
                margin-right: auto;
            }
            .card-header {
                text-align: center;
                margin-bottom: 1rem;
                margin-top: 0.5rem;
            }
            .card-title {
                font-size: 1.75rem;
                font-weight: 700;
                color: #1a202c;
                margin-bottom: 0.5rem;
                margin-top: 0.75rem;
            }
            .card-subtitle {
                font-size: 0.9rem;
                color: #64748b;
                max-width: 450px;
                margin: 0 auto;
                line-height: 1.4;
            }
            .role-options {
                display: flex;
                justify-content: center;
                gap: 1rem;
                margin-top: 1rem;
            }
            .role-card {
                border-radius: 1rem;
                padding: 1.75rem 1.25rem;
                text-align: center;
                color: white;
                min-height: 280px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
                transition: transform 0.3s, box-shadow 0.3s;
            }
            .role-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
            }
            .role-card.student {
                background: linear-gradient(135deg, #8b0000 0%, #2c1a1a 100%);
            }
            .role-card.teacher {
                background: linear-gradient(135deg, #64748b 0%, #1f2937 100%);
            }
            .role-card.main-access {
                background: linear-gradient(135deg, #8b0000 0%, #2c1a1a 100%);
                max-width: 350px;
                width: 100%;
                margin: 0 auto;
                min-height: 300px;
            }
            .role-icon {
                background-color: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                padding: 0.875rem;
                margin-bottom: 1.25rem;
                width: 4rem;
                height: 4rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .role-title {
                font-size: 1.7rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }
            .role-description {
                font-size: 1.1rem;
                line-height: 1.5;
                opacity: 0.9;
                margin-bottom: 1.75rem;
                max-width: 280px;
            }
            .btn {
                background-color: white;
                color: #1f2937;
                padding: 0.625rem 1.25rem;
                border-radius: 0.5rem;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.3s;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                font-size: 0.75rem;
            }
            .btn:hover {
                background-color: #f8fafc;
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                text-decoration: none;
            }
            .btn-disabled {
                background-color: rgba(255, 255, 255, 0.7);
                cursor: not-allowed;
            }
            .footer {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem 2rem;
                font-size: 0.75rem;
                color: rgba(255, 255, 255, 0.6);
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }
            @media (max-width: 640px) {
                .footer {
                    flex-direction: column;
                    gap: 0.5rem;
                    text-align: center;
                }
                .nav {
                    position: relative;
                    top: auto;
                    right: auto;
                    justify-content: center;
                    margin-bottom: 2rem;
                }
                .container {
                    padding: 1rem;
                }
                .welcome-card {
                    padding: 1.25rem;
                    margin: 1rem;
                    margin-top: 8rem;
                }
                .role-card {
                    min-height: 250px;
                    padding: 1.25rem 1rem;
                }
                .card-title {
                    font-size: 1.5rem;
                }
                .top-header {
                    padding: 1.5rem;
                }
                .top-header h1 {
                    font-size: 1.5rem;
                }
                .top-header p {
                    font-size: 0.875rem;
                }
            }
        </style>
    </head>
    <body>
        @auth
            {{-- Auto-redirigir usuarios logueados a su dashboard --}}
            <script>
                @if(auth()->user()->isAdmin())
                    window.location.href = '{{ route("admin.dashboard") }}';
                @elseif(auth()->user()->isProfesor())
                    window.location.href = '{{ route("profesor.dashboard") }}';
                @elseif(auth()->user()->isAlumno())
                    window.location.href = '{{ route("alumno.dashboard") }}';
                @endif
            </script>
        @endauth

        <!-- Video de fondo -->
        <video autoplay muted loop id="background-video">
            <source src="{{ asset('138962-770800093.mp4') }}" type="video/mp4">
            Tu navegador no soporta videos HTML5.
        </video>
        
        <!-- Overlay para mejorar legibilidad -->
        <div class="video-overlay"></div>
        
        <div class="container">
            <div class="top-header">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                    </svg>
                    Sistema de Gestión Escolar
                </h1>
                <p>Gestión integral para alumnos y profesores</p>
            </div>

            @if (Route::has('login'))
                <div class="nav">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Panel Principal</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="welcome-card">
                <div class="card-header">
                    <h1 class="card-title">Bienvenido al Sistema</h1>
                    <p class="card-subtitle">
                        Seleccione su rol para acceder al sistema de gestión escolar y comenzar a utilizar todas las funcionalidades disponibles
                    </p>
                </div>

                <div class="role-options">
                    <div class="role-card main-access">
                        <div class="role-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h2 class="role-title">Acceso al Sistema</h2>
                        <p class="role-description">
                            Profesores y Alumnos - Accede a tu cuenta del sistema educativo
                        </p>
                        @guest
                            <a href="{{ route('login') }}" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                                INICIAR SESIÓN
                            </a>
                        @endguest
                    </div>
                </div>
            </div>

            <div class="footer">
                <div>
                    <strong>Programación IV</strong> - Sistema de Gestión Escolar
                </div>
                <div>
                    Desarrollado con Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </body>
</html>
                margin: 0;
                padding: 0;
            }
            body {
                font-family: 'instrument-sans', sans-serif;
                background: #111827;
                color: #f1f5f9;
                min-height: 100vh;
                margin: 0;
                display: flex;
                flex-direction: column;
                position: relative;
                overflow-x: hidden;
            }
            
            /* Video de fondo */
            #background-video {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: -10;
            }
            
            /* Overlay para mejorar la legibilidad del texto */
            .video-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                z-index: 0;
                pointer-events: none;
            }
            .container {
                width: 100%;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem;
                position: relative;
                z-index: 1;
            }
            .top-header {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #8b0000 0%, #2c1a1a 100%);
                color: white;
                text-align: center;
                padding: 2rem;
                z-index: 5;
            }
            .top-header h1 {
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.75rem;
            }
            .top-header p {
                font-size: 1rem;
                opacity: 0.9;
            }
            .nav {
                position: absolute;
                top: 2rem;
                right: 1.5rem;
                display: flex;
                gap: 1rem;
                z-index: 10;
            }
            .nav-link {
                color: white;
                text-decoration: none;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                font-weight: 500;
                transition: all 0.3s;
                background-color: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.2);
                text-decoration: none;
            }
            .welcome-card {
                background-color: white;
                border-radius: 1.5rem;
                padding: 2rem;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                max-width: 700px;
                width: 100%;
                color: #1a202c;
                margin-top: 5rem;
            }
            .card-header {
                text-align: center;
                margin-bottom: 1.5rem;
            }
            .card-title {
                font-size: 1.75rem;
                font-weight: 700;
                color: #1a202c;
                margin-bottom: 0.5rem;
            }
            .card-subtitle {
                font-size: 0.9rem;
                color: #64748b;
                max-width: 450px;
                margin: 0 auto;
                line-height: 1.4;
            }
            .role-options {
                display: flex;
                justify-content: center;
                gap: 1.25rem;
                margin-top: 1.25rem;
            }
            .role-card {
                border-radius: 1rem;
                padding: 1.75rem 1.25rem;
                text-align: center;
                color: white;
                min-height: 280px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
                transition: transform 0.3s, box-shadow 0.3s;
            }
            .role-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
            }
            .role-card.student {
                background: linear-gradient(135deg, #8b0000 0%, #2c1a1a 100%);
            }
            .role-card.teacher {
                background: linear-gradient(135deg, #64748b 0%, #1f2937 100%);
            }
            .role-card.main-access {
                background: linear-gradient(135deg, #8b0000 0%, #2c1a1a 100%);
                max-width: 400px;
                margin: 0 auto;
            }
            .role-icon {
                background-color: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                padding: 0.875rem;
                margin-bottom: 1.25rem;
                width: 4rem;
                height: 4rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .role-title {
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 0.875rem;
            }
            .role-description {
                font-size: 0.875rem;
                line-height: 1.4;
                opacity: 0.9;
                margin-bottom: 1.5rem;
                max-width: 220px;
            }
            .btn {
                background-color: white;
                color: #1f2937;
                padding: 0.625rem 1.25rem;
                border-radius: 0.5rem;
                font-weight: 700;
                text-decoration: none;
                transition: all 0.3s;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                font-size: 0.75rem;
            }
            .btn:hover {
                background-color: #f8fafc;
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                text-decoration: none;
            }
            .btn-disabled {
                background-color: rgba(255, 255, 255, 0.7);
                cursor: not-allowed;
            }
            .footer {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem 2rem;
                font-size: 0.75rem;
                color: rgba(255, 255, 255, 0.6);
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }
            @media (max-width: 640px) {
                .footer {
                    flex-direction: column;
                    gap: 0.5rem;
                    text-align: center;
                }
                .nav {
                    position: relative;
                    top: auto;
                    right: auto;
                    justify-content: center;
                    margin-bottom: 2rem;
                }
                .container {
                    padding: 1rem;
                }
                .welcome-card {
                    padding: 1.25rem;
                    margin: 1rem;
                    margin-top: 6rem;
                }
                .role-card {
                    min-height: 250px;
                    padding: 1.25rem 1rem;
                }
                .card-title {
                    font-size: 1.5rem;
                }
                .top-header {
                    padding: 1.5rem;
                }
                .top-header h1 {
                    font-size: 1.5rem;
                }
                .top-header p {
                    font-size: 0.875rem;
                }
            }
        </style>
    </head>
    <body>
        @auth
            {{-- Auto-redirigir usuarios logueados a su dashboard --}}
            <script>
                @if(auth()->user()->isAdmin())
                    window.location.href = '{{ route("admin.dashboard") }}';
                @elseif(auth()->user()->isProfesor())
                    window.location.href = '{{ route("profesor.dashboard") }}';
                @elseif(auth()->user()->isAlumno())
                    window.location.href = '{{ route("alumno.dashboard") }}';
                @endif
            </script>
        @endauth

        <!-- Video de fondo -->
        <video autoplay muted loop id="background-video">
            <source src="{{ asset('138962-770800093.mp4') }}" type="video/mp4">
            Tu navegador no soporta videos HTML5.
        </video>
        
        <!-- Overlay para mejorar legibilidad -->
        <div class="video-overlay"></div>
        
        <div class="container">
            <div class="top-header">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                    </svg>
                    Sistema de Gestión Escolar
                </h1>
                <p>Gestión integral para alumnos y profesores</p>
            </div>

            @if (Route::has('login'))
                <div class="nav">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Panel Principal</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="welcome-card">
                <div class="card-header">
                    <h1 class="card-title">Bienvenido al Sistema</h1>
                    <p class="card-subtitle">
                        Seleccione su rol para acceder al sistema de gestión escolar y comenzar a utilizar todas las funcionalidades disponibles
                    </p>
                </div>

                <div class="role-options">
                    <div class="role-card main-access">
                        <div class="role-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h2 class="role-title">Acceso al Sistema</h2>
                        <p class="role-description">
                            Profesores y Alumnos - Accede a tu cuenta del sistema educativo
                        </p>
                        @guest
                            <a href="{{ route('login') }}" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                                INICIAR SESIÓN
                            </a>
                        @endguest
                    </div>
                </div>
            </div>

            <div class="footer">
                <div>
                    <strong>Programación IV</strong> - Sistema de Gestión Escolar
                </div>
                <div>
                    Desarrollado con Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </body>
</html>
