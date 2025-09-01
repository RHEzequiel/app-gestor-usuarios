<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ request()->routeIs('login') ? 'Login' : (request()->routeIs('register') ? 'Registro' : 'Acceso') }}</title>
        
        <!-- Favicon -->
        <link rel="icon" href="/logo_utn.png" sizes="any">
        <link rel="icon" href="/logo_utn.png" type="image/png+xml">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
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
                background: rgba(0, 0, 0, 0.3);
                z-index: -5;
                pointer-events: none;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Video de fondo -->
        <video id="background-video" autoplay loop muted playsinline>
            <source src="/138962-770800093.mp4" type="video/mp4">
            Tu navegador no soporta videos HTML5.
        </video>
        
        <!-- Overlay para mejorar contraste -->
        <div class="video-overlay"></div>
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 pb-10 relative z-10">
            <div class="mb-4">
                <a href="/" class="flex items-center justify-center">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-800" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-6 py-6 overflow-hidden border border-gray-100 shadow-md rounded-lg" style="background: linear-gradient(135deg, #8b0000 0%, #2c1a1a 100%); color: white; border: none;">
                {{ $slot }}
            </div>
            
            <div class="mt-6 text-center text-sm text-white text-opacity-80" style="margin-bottom: 27px;">
                &copy; {{ date('Y') }} UTN. Todos los derechos reservados.
            </div>
        </div>
    </body>
</html>
