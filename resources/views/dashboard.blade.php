<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mi Ranking
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('logout') }}">

        @csrf

        <button type="submit">
            Cerrar sesión
        </button>

    </form>

    @php
        $nombre = auth()->user()->name ?? 'Estudiante';
        $ranking = $registro->ranking ?? null;
        $promedio = $registro->promedio ?? 0;
        
        $rendimiento = $registro->rendimiento ?? 0;
        $comportamiento = $registro->comportamiento ?? 0;
        $pagos = $registro->pagos ?? 0;
        $referente = $registro->referente ?? 0;
        
        $semestre = $registro->semestre_estudiante ?? '—';

        $estado = $ranking !== null && $ranking <= 5
            ? 'Top 5%'
            : 'Ranking General';

        // TOTAL REAL DEL PUNTAJE
        $total = $rendimiento + $comportamiento + $pagos + $referente;

        // EVITAR DIVISIÓN ENTRE 0
        $total = $total > 0 ? $total : 1;

        // PORCENTAJES PARA EL GRÁFICO CIRCULAR
        $p1 = ($rendimiento / $total) * 100;
        $p2 = ($comportamiento / $total) * 100;
        $p3 = ($pagos / $total) * 100;
        $p4 = ($referente / $total) * 100;

        // ACUMULADOS DEL CÍRCULO
        $c1 = $p1;
        $c2 = $p1 + $p2;
        $c3 = $p1 + $p2 + $p3;

        // VARIABLES FALTANTES PARA LAS BARRAS DE PROGRESO
        // (Asumo que la nota máxima es 20. Si la nota máxima es otra, cambia el "20" por ese número)
        $rendimientoBar = ($rendimiento / 2000) * 100;
        $comportamientoBar = ($comportamiento / 2000) * 100;
        $pagosBar = ($pagos / 2000) * 100;
        $referenteBar = ($referente / 2000) * 100;
    @endphp

    <div class="min-h-screen bg-[#f6f7fb]">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[240px_1fr]">

                <!-- Sidebar -->
                <aside class="rounded-3xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <div class="mb-8">
                        <div class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-500">
                            Portal Estudiantil
                        </div>
                        <div class="mt-1 text-xs text-gray-400">Excelencia por insight</div>
                    </div>

                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700">
                            <span>▣</span>
                            Mi Ranking
                        </a>
                        <a href="#historial" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-800">
                            <span>◌</span>
                            Historial
                        </a>
                    </nav>

                    <div class="mt-10 rounded-2xl bg-gray-50 p-4 text-sm text-gray-500">
                        <div class="mb-1 font-semibold text-gray-700">Centro de Ayuda</div>
                        <p>Consulta tu rendimiento y posición dentro del ranking general.</p>
                    </div>
                </aside>

                <!-- Main -->
                <main class="space-y-6">
                    <!-- Top welcome -->
                    <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                            <div class="max-w-2xl">
                                <p class="text-xs font-bold uppercase tracking-[0.25em] text-rose-500">
                                    Mi rendimiento
                                </p>
                                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-[#1f2a7a] sm:text-4xl">
                                    Bienvenido, {{ $nombre }}
                                </h1>
                                <p class="mt-3 max-w-xl text-sm leading-6 text-gray-500">
                                    Tu rendimiento académico actual se encuentra en el semestre {{ $semestre }}.
                                    Aquí puedes revisar tu ranking, promedio y componentes de evaluación.
                                </p>
                            </div>

                            <div class="w-full max-w-xs rounded-3xl bg-[#fafbff] p-5 shadow-sm ring-1 ring-gray-100">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">
                                    Posición actual
                                </p>
                                <div class="mt-4 text-center">
                                    <div class="text-5xl font-black tracking-tight text-[#1f2a7a]">
                                        #{{ $ranking ?? '—' }}
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500">en el Ranking General</p>
                                    <span class="mt-4 inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        {{ $estado }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Content grid -->
                    <section class="grid grid-cols-1 gap-6 xl:grid-cols-[1.2fr_0.8fr]">
                        <!-- Chart card -->
                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_280px] lg:items-center">
                                <div>
                                    <div class="mb-5 flex items-center justify-between">
                                        <h2 class="text-base font-bold text-gray-800">Distribución del puntaje</h2>
                                        <span class="text-xs font-semibold text-gray-400">Periodo actual</span>
                                    </div>

                                    <!-- GRÁFICO CIRCULAR CORREGIDO -->
                                    <div class="mx-auto flex h-72 w-72 items-center justify-center rounded-full"
                                        style="background: conic-gradient(#1f2a7a 0% {{ $c1 }}%, #22b8b2 {{ $c1 }}% {{ $c2 }}%, #ef4444 {{ $c2 }}% {{ $c3 }}%, #9ca3af {{ $c3 }}% 100%);">
                                        
                                        <div class="flex h-44 w-44 flex-col items-center justify-center rounded-full bg-white shadow-sm">
                                            <div class="text-4xl font-black text-[#1f2a7a]">
                                                {{ number_format($promedio, 2) }}
                                            </div>
                                            <div class="mt-1 text-xs uppercase tracking-[0.2em] text-gray-400">
                                                Promedio
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex flex-wrap gap-4 text-sm text-gray-500">
                                        <div class="flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-[#1f2a7a]"></span> Rendimiento Académico</div>
                                        <div class="flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-[#22b8b2]"></span> Comportamiento e Identidad</div>
                                        <div class="flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-[#ef4444]"></span> Puntualidad de Pagos</div>
                                        <div class="flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-[#e5e7eb]"></span> Alumnos Referentes</div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <!-- BARRAS DE PROGRESO CORREGIDAS -->
                                    <div class="rounded-2xl bg-gray-50 p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-700">Rendimiento Académico</div>
                                                <div class="text-xs text-gray-400">Evaluaciones y créditos</div>
                                            </div>
                                            <div class="text-2xl font-black text-[#1f2a7a]">{{ number_format($rendimiento, 2) }}</div>
                                        </div>
                                        <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                                            <div class="h-2 rounded-full bg-[#1f2a7a]" style="width: {{ $rendimientoBar }}%"></div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl bg-gray-50 p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-700">Comportamiento e Identidad</div>
                                                <div class="text-xs text-gray-400">Participación y valores</div>
                                            </div>
                                            <div class="text-2xl font-black text-[#1f2a7a]">{{ number_format($comportamiento, 2) }}</div>
                                        </div>
                                        <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                                            <div class="h-2 rounded-full bg-[#22b8b2]" style="width: {{ $comportamientoBar }}%"></div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl bg-gray-50 p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-700">Puntualidad de Pagos</div>
                                                <div class="text-xs text-gray-400">Estado de cuenta</div>
                                            </div>
                                            <div class="text-2xl font-black text-[#1f2a7a]">{{ number_format($pagos, 2) }}</div>
                                        </div>
                                        <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                                            <div class="h-2 rounded-full bg-[#ef4444]" style="width: {{ $pagosBar }}%"></div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl bg-gray-50 p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-700">Alumnos Referentes</div>
                                                <div class="text-xs text-gray-400">Liderazgo y méritos</div>
                                            </div>
                                            <div class="text-2xl font-black text-[#1f2a7a]">{{ number_format($referente, 2) }}</div>
                                        </div>
                                        <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                                            <div class="h-2 rounded-full bg-slate-500" style="width: {{ $referenteBar }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Summary card -->
                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                            <p class="text-xs font-bold uppercase tracking-[0.25em] text-rose-500">
                                Resumen de calificación
                            </p>

                            <div class="mt-3">
                                <h3 class="text-2xl font-extrabold text-[#1f2a7a]">Puntaje Total Acumulado</h3>
                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Este puntaje es un promedio ponderado de tu desempeño académico, participación, puntualidad y liderazgo institucional.
                                </p>
                            </div>

                            <div class="mt-8 rounded-3xl bg-[#f7f8ff] p-6 text-center">
                                <div class="text-6xl font-black tracking-tight text-[#1f2a7a]">
                                    {{ number_format($promedio, 2) }}
                                </div>
                                <div class="mt-1 text-lg font-semibold text-gray-400">/ 2000.0</div>
                            </div>

                            <div class="mt-6 rounded-2xl bg-emerald-50 p-4">
                                <div class="text-sm font-semibold text-emerald-700">Estado actual</div>
                                <div class="mt-1 text-sm text-emerald-600">
                                    {{ $ranking !== null && $ranking <= 5 ? 'Postulante elegible para beneficios' : 'En seguimiento académico' }}
                                </div>
                            </div>

                            <div class="mt-4 rounded-2xl bg-gray-50 p-4 text-sm text-gray-600">
                                <div class="font-semibold text-gray-700">Semestre</div>
                                <div class="mt-1">{{ $semestre }}</div>
                            </div>
                        </div>
                    </section>

                    <!-- Footer-like cards -->
                    <section id="historial" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                            <h3 class="text-lg font-bold text-gray-800">Último movimiento</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Tu posición actual es <span class="font-semibold text-gray-700">#{{ $ranking ?? '—' }}</span>.
                                El sistema cargó tu último registro desde la base de datos.
                            </p>
                        </div>

                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                            <h3 class="text-lg font-bold text-gray-800">Próxima revisión</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Tu ranking se actualizará cuando se cargue el siguiente periodo.
                            </p>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>