<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-white">Acceso al Sistema</h2>
        <p class="text-white mt-2">Selecciona tu rol e ingresa tus credenciales</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Role Selection - PRIMERO -->
        <div class="mb-6">
            <x-input-label for="intended_role" :value="__('Acceder como:')" class="text-white font-semibold mb-3" />
            <div class="flex gap-4">
                <label class="flex-1 cursor-pointer">
                    <input type="radio" name="intended_role" value="profesor" class="sr-only" required>
                    <div class="role-selector bg-red-100 border-2 border-red-300 text-red-700 px-6 py-4 rounded-lg hover:bg-red-200 transition-all text-center">
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.84L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.75 2.524z" />
                            </svg>
                            <span class="font-semibold">📚 Profesor</span>
                        </div>
                    </div>
                </label>
                <label class="flex-1 cursor-pointer">
                    <input type="radio" name="intended_role" value="alumno" class="sr-only" required>
                    <div class="role-selector bg-red-100 border-2 border-red-300 text-red-700 px-6 py-4 rounded-lg hover:bg-red-200 transition-all text-center">
                        <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold">🎓 Alumno</span>
                        </div>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('intended_role')" class="mt-2" />
        </div>
        
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white font-medium mb-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none" style="z-index: 10;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <input id="email" class="block mt-1 w-full pl-10 border border-gray-300 rounded-md py-2 bg-white" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="tu@email.com" style="outline: none !important; box-shadow: none !important; border-color: #d1d5db !important;" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" class="text-white font-medium mb-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none" style="z-index: 10;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="password" class="block mt-1 w-full pl-10 border border-gray-300 rounded-md py-2 bg-white"
                              type="password"
                              name="password"
                              required autocomplete="current-password"
                              placeholder="••••••" style="outline: none !important; box-shadow: none !important; border-color: #d1d5db !important;" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 bg-white" name="remember" style="accent-color: #4b5563; outline: none !important; box-shadow: none !important;">
                <span class="ms-2 text-sm text-white">{{ __('Recordar mis datos') }}</span>
            </label>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full bg-gradient-to-r from-red-800 to-red-900 hover:from-red-900 hover:to-red-800 focus:ring-red-500">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
        
        <div class="flex items-center justify-between mt-10 pt-4 border-t border-white border-opacity-20">
            <a class="text-sm text-white hover:text-white hover:underline" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
            </a>
            
            <a class="text-sm text-white hover:text-white hover:underline" href="{{ route('register') }}">
                {{ __('¿No tienes cuenta? Regístrate') }}
            </a>
        </div>
    </form>

    <style>
        input[type="radio"]:checked + .role-selector {
            background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%) !important;
            border-color: #6b7280 !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3) !important;
        }
        .role-selector {
            transition: all 0.2s ease;
        }
        .role-selector:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[name="intended_role"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Reset all buttons
                    document.querySelectorAll('.role-selector').forEach(btn => {
                        btn.classList.remove('bg-indigo-600', 'border-indigo-600', 'text-white');
                        // Restore original colors
                        if (btn.parentNode.querySelector('input[value="profesor"]')) {
                            btn.classList.add('bg-red-100', 'border-red-300', 'text-red-700');
                        } else {
                            btn.classList.add('bg-red-100', 'border-red-300', 'text-red-700');
                        }
                    });
                });
            });
        });
    </script>
</x-guest-layout>
