<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            📊 Panel Supervisor - Ranking Institucional
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filtros (SOLO LECTURA) -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Carrera</label>
                        <select name="carrera" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="">Todas las carreras</option>
                            @foreach($carreras as $carrera)
                                <option value="{{ $carrera->id }}" {{ request('carrera') == $carrera->id ? 'selected' : '' }}>
                                    {{ $carrera->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Semestre</label>
                        <select name="semestre" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="">Todos los semestres</option>
                            @foreach($semestres as $semestre)
                                <option value="{{ $semestre->id }}" {{ request('semestre') == $semestre->id ? 'selected' : '' }}>
                                    {{ $semestre->nombre ?? 'Semestre ' . $semestre->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabla Ranking (SOLO LECTURA) -->
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Estudiante</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Carrera</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Promedio</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Rendimiento</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Comportamiento</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Pagos</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Referentes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ranking as $key => $nota)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-lg text-center">
                                    @if($ranking->currentPage() == 1)
                                        {{ $loop->index + 1 }}
                                    @else
                                        {{ ($ranking->currentPage() - 1) * $ranking->perPage() + $loop->index + 1 }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold">{{ $nota->estudiante->name }}</td>
                                <td class="px-6 py-4">{{ $nota->carrera->nombre ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-center font-bold text-lg">{{ number_format($nota->promedio, 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($nota->rendimiento, 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($nota->comportamiento, 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($nota->pagos, 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($nota->referente, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    No hay registros para mostrar
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $ranking->links() }}
            </div>

            <!-- Nota de seguridad -->
            <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-sm text-blue-700">
                    <strong>✓ Modo Solo Lectura:</strong> Como supervisor, puedes visualizar el ranking completo de todos los semestres, pero no tienes permisos para editar, crear o eliminar registros.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>