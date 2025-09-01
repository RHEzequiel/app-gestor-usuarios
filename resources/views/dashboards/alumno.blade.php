<x-app-layout>
    <x-slot name="header">
        Panel del Alumno
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">¡Bienvenido, {{ Auth::user()->name }}!</h3>
                    
                    <p class="mb-4">
                        Desde aquí puedes ver y editar tu perfil.
                    </p>
                    
                    <div class="mt-6 bg-indigo-50 p-4 rounded-lg">
                        <h4 class="font-medium text-indigo-800 mb-2">Mi Perfil</h4>
                        <div class="space-y-2">
                            <a href="{{ route('admin.users.show', Auth::id()) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ver Mi Perfil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
