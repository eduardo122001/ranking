<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            📊 Ranking Detallado por Semestre
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filtros -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Semestre</label>
                        <select name="semestre_estudiante" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="">Todos</option>
                            @foreach($semestresEstudiante as $sem)
                                <option value="{{ $sem }}" {{ request('semestre_estudiante') == $sem ? 'selected' : '' }}>
                                    Semestre {{ $sem }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Carrera</label>
                        <select name="carrera" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="">Todas</option>
                            @foreach($carreras as $carrera)
                                <option value="{{ $carrera->id }}" {{ request('carrera') == $carrera->id ? 'selected' : '' }}>
                                    {{ $carrera->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabla -->
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Estudiante</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Carrera</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Semestre Est.</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Promedio</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Rendimiento</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Comportamiento</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Pagos</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Referentes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ranking as $nota)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-bold">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $nota->estudiante->name }}</td>
                                <td class="px-6 py-4">{{ $nota->carrera->nombre ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-center">{{ $nota->semestre_estudiante }}</td>
                                <td class="px-6 py-4 text-center font-bold text-lg">{{ number_format($nota->promedio, 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($nota->rendimiento, 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($nota->comportamiento, 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($nota->pagos, 2) }}</td>
                                <td class="px-6 py-4 text-center">{{ number_format($nota->referente, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                    No hay registros
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $ranking->links() }}
            </div>
        </div>
    </div>
</x-app-layout>