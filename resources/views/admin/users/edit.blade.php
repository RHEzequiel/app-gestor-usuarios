@use('Illuminate\Support\Facades\Storage')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__('Teléfono (opcional)')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input-label for="professional_url" :value="__('Enlace Profesional (opcional)')" />
                            <x-text-input id="professional_url" name="professional_url" type="url" class="mt-1 block w-full" :value="old('professional_url', $user->professional_url)" />
                            <x-input-error class="mt-2" :messages="$errors->get('professional_url')" />
                        </div>

                        <div>
                            <x-input-label for="photo" :value="__('Foto de Perfil')" />
                            
                            @if ($user->photo_path)
                                <div class="mt-2 mb-4">
                                    <img src="{{ Storage::url($user->photo_path) }}" alt="{{ $user->name }}" class="w-32 h-32 object-cover rounded">
                                    <p class="mt-1 text-sm text-gray-500">Foto actual</p>
                                </div>
                            @endif
                            
                            <input id="photo" name="photo" type="file" accept="image/*" class="mt-1 block w-full" />
                            <p class="mt-1 text-sm text-gray-500">
                                @if ($user->photo_path)
                                    Sube una nueva foto solo si deseas cambiar la actual.
                                @else
                                    Sube una foto de perfil.
                                @endif
                            </p>
                            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Guardado.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('admin.users.show', $user) }}" class="text-gray-600 hover:text-gray-900">
                    &larr; Volver al perfil
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
