<x-app-layout>
    <x-slot name="header">
        Panel de Administrador
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">¡Bienvenido, Administrador!</h3>
                    
                    <p class="mb-4">
                        Desde aquí puedes gestionar todos los usuarios del sistema.
                    </p>
                    
                    <div class="mt-6 bg-blue-50 p-4 rounded-lg">
                        <h4 class="font-medium text-blue-800 mb-2">Acciones Disponibles</h4>
                        <div class="space-y-2">
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ver Listado de Usuarios
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
