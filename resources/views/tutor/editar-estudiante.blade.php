<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ $estudiante ? 'Editar Estudiante' : 'Crear Nuevo Estudiante' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                
                <form method="POST" action="{{ $estudiante ? route('tutor.actualizar-estudiante', $estudiante->id) : route('tutor.guardar-estudiante') }}">
                    @csrf
                    @if($estudiante)
                        @method('POST')
                    @endif

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $estudiante->name ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $estudiante->email ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">DNI</label>
                        <input type="text" name="dni" value="{{ old('dni', $estudiante->dni ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" maxlength="8" required>
                        @error('dni') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">
                            Contraseña {{ $estudiante ? '(dejar vacío para no cambiar)' : '' }}
                        </label>
                        <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2" {{ $estudiante ? '' : 'required' }}>
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                            {{ $estudiante ? 'Actualizar' : 'Crear' }}
                        </button>
                        <a href="{{ route('tutor.dashboard') }}" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>