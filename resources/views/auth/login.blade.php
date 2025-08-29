<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-indigo-700">Acceso al Sistema</h2>
        <p class="text-gray-500 mt-2">Ingresa tus credenciales para continuar</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium mb-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <x-text-input id="email" class="block mt-1 w-full pl-10 border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="tu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium mb-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input id="password" class="block mt-1 w-full pl-10 border-gray-300 rounded-md focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2"
                              type="password"
                              name="password"
                              required autocomplete="current-password"
                              placeholder="••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recordar mis datos') }}</span>
            </label>
        </div>

        <div class="mt-6">
            <x-primary-button>
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
        
        <div class="flex items-center justify-between mt-10 pt-4 border-t border-gray-100">
            <a class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
            </a>
            
            <a class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline" href="{{ route('register') }}">
                {{ __('¿No tienes cuenta? Regístrate') }}
            </a>
        </div>
    </form>
</x-guest-layout>
