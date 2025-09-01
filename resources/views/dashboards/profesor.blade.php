<x-app-layout>
    <x-slot name="header">
        Panel del Profesor
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">¡Bienvenido, Profesor!</h3>
                    
                    <p class="mb-4">
                        Desde aquí puedes buscar y ver información de los alumnos.
                    </p>
                    
                    <div class="mt-6 bg-green-50 p-4 rounded-lg">
                        <h4 class="font-medium text-green-800 mb-2">Acciones Disponibles</h4>
                        <div class="space-y-2">
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ver Alumnos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
