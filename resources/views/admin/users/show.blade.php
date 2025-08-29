@use('Illuminate\Support\Facades\Storage')

<x-app-layout>
    <x-slot name="header">
        Perfil de Usuario
    </x-slot>

    <div class="content-card bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="p-6 text-gray-900">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 mb-4 md:mb-0">
                            <div class="flex flex-col items-center">
                                @if ($user->photo_path)
                                    <div class="rounded-xl shadow-lg overflow-hidden border-4 border-white ring-2 ring-indigo-100">
                                        <img src="{{ Storage::url($user->photo_path) }}" alt="{{ $user->name }}" class="w-48 h-48 object-cover">
                                    </div>
                                @else
                                    <div class="w-48 h-48 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg flex items-center justify-center border-4 border-white">
                                        <span class="text-5xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                @endif

                                @if (Auth::user()->is_admin || Auth::id() === $user->id)
                                    <a href="{{ route('admin.users.edit', $user) }}" class="mt-6 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all flex items-center justify-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Editar Perfil
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="md:w-2/3 md:pl-6">
                            <div class="mb-6">
                                <h3 class="text-2xl font-bold text-indigo-800 pb-2 border-b-2 border-indigo-100 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Información Personal
                                </h3>
                            </div>

                            <div class="mb-6 bg-gray-50 rounded-lg p-4 border-l-4 border-indigo-400">
                                <div class="text-gray-500 text-sm uppercase tracking-wide font-semibold">Nombre</div>
                                <div class="text-lg font-medium text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $user->name }}
                                </div>
                            </div>

                            <div class="mb-6 bg-gray-50 rounded-lg p-4 border-l-4 border-indigo-400">
                                <div class="text-gray-500 text-sm uppercase tracking-wide font-semibold">Email</div>
                                <div class="text-lg font-medium">
                                    <a href="mailto:{{ $user->email }}" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        {{ $user->email }}
                                    </a>
                                </div>
                            </div>

                            <div class="mb-6 bg-gray-50 rounded-lg p-4 border-l-4 border-indigo-400">
                                <div class="text-gray-500 text-sm uppercase tracking-wide font-semibold">Teléfono</div>
                                <div class="text-lg font-medium">
                                    @if ($user->phone)
                                        <a href="{{ $user->whatsappUrl() }}" target="_blank" class="text-green-600 hover:text-green-800 flex items-center">
                                            <svg class="h-5 w-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.384"/>
                                            </svg>
                                            {{ $user->phone }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">No disponible</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-6 bg-gray-50 rounded-lg p-4 border-l-4 border-indigo-400">
                                <div class="text-gray-500 text-sm uppercase tracking-wide font-semibold">Enlace Profesional</div>
                                <div class="text-lg font-medium">
                                    @if ($user->professional_url)
                                        <a href="{{ $user->professional_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $user->professional_url }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">No disponible</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-6 bg-gray-50 rounded-lg p-4 border-l-4 border-indigo-400">
                                <div class="text-gray-500 text-sm uppercase tracking-wide font-semibold">Rol</div>
                                <div class="text-lg font-medium">
                                    @if ($user->is_admin)
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            Administrador
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                            </svg>
                                            Alumno
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @if (Auth::user()->is_admin)
                <div class="mt-4">
                    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900">
                        &larr; Volver al listado de usuarios
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
