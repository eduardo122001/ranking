<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Gestión de Estudiantes - Tutor
            </h2>
            <a href="{{ route('tutor.crear-estudiante') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Nuevo Estudiante
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Botón Ranking -->
            <div class="mb-6">
                <a href="{{ route('tutor.ranking') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                    📊 Ver Ranking Completo
                </a>
            </div>

            <!-- Mensajes -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla de Estudiantes -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Nombre</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">DNI</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($estudiantes as $estudiante)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $estudiante->name }}</td>
                                <td class="px-6 py-4">{{ $estudiante->email }}</td>
                                <td class="px-6 py-4">{{ $estudiante->dni }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('tutor.editar-estudiante', $estudiante->id) }}" class="text-blue-600 hover:underline text-sm">Editar</a>
                                    <form action="{{ route('tutor.eliminar-estudiante', $estudiante->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar estudiante?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm ml-2">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    No hay estudiantes registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $estudiantes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
