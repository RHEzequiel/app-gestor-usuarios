<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sistema de Gestión de Alumnos</title>
        
        <!-- Favicon -->
        <link rel="icon" href="/logo_utn.png" sizes="any">
        <link rel="icon" href="/logo_utn.png" type="image/png+xml">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=nunito:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Custom styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #f3f4f6;
            }
            .admin-header {
                background: linear-gradient(135deg, #8b0000 0%, #2c1a1a 100%);
                color: white;
            }
            .sidebar-link {
                transition: all 0.3s;
                border-left: 4px solid transparent;
            }
            .sidebar-link:hover, .sidebar-link.active {
                background-color: #e0e7ff;
                border-left-color: #4f46e5;
                color: #4338ca;
            }
            .content-card {
                border-radius: 0.75rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
            .btn-primary {
                background-color: #4f46e5;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                font-weight: 600;
                transition: all 0.2s;
            }
            .btn-primary:hover {
                background-color: #4338ca;
            }
            .table-header {
                background-color: #f9fafb;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col">
            <!-- Admin Header -->
            <header class="admin-header shadow-md">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center py-3">
                        <div class="flex items-center">
                            <a href="{{ route('dashboard') }}" class="flex items-center">
                                <x-application-logo class="block h-8 w-auto fill-current text-white" />
                                <span class="ml-3 text-lg font-semibold">Sistema de Gestión de Alumnos</span>
                            </a>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-white hover:text-indigo-100 focus:outline-none transition ease-in-out duration-150">
                                            <span class="mr-2">{{ Auth::user()->name }}</span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Mi Perfil') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Cerrar Sesión') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex flex-1">
                <!-- Sidebar -->
                <div class="w-64 bg-white shadow-md hidden md:block">
                    <div class="py-4 px-3">
                        <div class="mb-3 px-4 py-2 text-xs text-gray-500 uppercase font-semibold">
                            Menú Principal
                        </div>
                        
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                    Panel Principal
                                </a>
                            </li>
                            @if(Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>
                                        Usuarios
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('admin.users.show', Auth::id()) }}" class="sidebar-link flex items-center px-4 py-2 text-gray-700 rounded-md {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                    </svg>
                                    Mi Perfil
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-6 lg:p-8">
                    <!-- Page Heading -->
                    @isset($header)
                        <div class="mb-6">
                            <h1 class="text-2xl font-bold text-gray-800">{{ $header }}</h1>
                        </div>
                    @endisset

                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
