<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mi Ranking
        </h2>
    </x-slot>

    @php
        $nombre = auth()->user()->name ?? 'Estudiante';
        $ranking = $registro->ranking ?? null;
        
        // NOTAS REALES DEL ESTUDIANTE (BASE 2000)
        $rendimiento = $registro->rendimiento ?? 0;
        $comportamiento = $registro->comportamiento ?? 0;
        $pagos = $registro->pagos ?? 0;
        $referente = $registro->referente ?? 0;
        
        // REVISAR LA NUEVA ESTRUCTURA DE RELACIONES
        $semestre_objeto = $registro->semestre ?? null;
        $semestre = $semestre_objeto->nombre ?? '—';
        $periodo_nombre = $semestre; // Para tu Opción A

        // El semestre ahora es el que contiene la relación al peso
        $peso_dinamico_db = $semestre_objeto->peso ?? null;

        $estado = $ranking !== null && $ranking <= 5
            ? 'Top 5%'
            : 'Ranking General';

        // PESOS DINÁMICOS DESDE LA NUEVA RELACIÓN (Con respaldos por si vienen nulos)
        $w1 = $peso_dinamico_db->rendimiento ?? 0.35;
        $w2 = $peso_dinamico_db->comportamiento ?? 0.35;
        $w3 = $peso_dinamico_db->pagos ?? 0.15;
        $w4 = $peso_dinamico_db->referente ?? 0.15;

        // CONVERSIÓN A PORCENTAJES PARA LAS BARRAS
        $p1 = $w1 * 100;
        $p2 = $w2 * 100;
        $p3 = $w3 * 100;
        $p4 = $w4 * 100;

        // ACUMULADOS PARA EL GRÁFICO CIRCULAR
        $c1 = $p1;
        $c2 = $p1 + $p2;
        $c3 = $p1 + $p2 + $p3;

        // RECALCULO DINÁMICO PONDERADO
        $promedio_dinamico = ($rendimiento * $w1) + ($comportamiento * $w2) + ($pagos * $w3) + ($referente * $w4);
    @endphp

    <div class="min-h-screen bg-[#f6f7fb]">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[240px_1fr]">

                <aside class="flex flex-col justify-between rounded-3xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <div>
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
                    </div>

                    <div class="mt-8 hidden lg:block border-t border-gray-100 pt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-rose-500 transition-colors hover:bg-rose-50 hover:text-rose-700">
                                <span>⎋</span>
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </aside>

                <main class="space-y-6">
                    <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                            <div class="max-w-2xl">
                                <p class="text-xs font-bold uppercase tracking-[0.25em] text-rose-500">
                                    Mi rendimiento
                                </p>
                                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-[#1f2a7a] sm:text-4xl">
                                    Bienvenido, {{ $nombre }}
                                </h1>
                                <p class="mt-3 max-w-xl text-sm leading-6 text-gray-500 flex flex-wrap items-center gap-2">
                                    <span>Tu rendimiento académico actual se encuentra registrado.</span>
                                    <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                                        Periodo {{ $periodo_nombre }}
                                    </span>
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

                    <section class="grid grid-cols-1 gap-6 xl:grid-cols-[1.2fr_0.8fr]">
                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_280px] lg:items-center">
                                <div>
                                    <div class="mb-5 flex items-center justify-between">
                                        <h2 class="text-base font-bold text-gray-800">Pesos del Semestre {{ $semestre }}</h2>
                                    </div>

                                    <div class="mx-auto flex h-72 w-72 items-center justify-center rounded-full"
                                         style="background: conic-gradient(#1f2a7a 0% {{ $c1 }}%, #22b8b2 {{ $c1 }}% {{ $c2 }}%, #ef4444 {{ $c2 }}% {{ $c3 }}%, #e5e7eb {{ $c3 }}% 100%);">
                                        
                                        <div class="flex h-44 w-44 flex-col items-center justify-center rounded-full bg-white shadow-sm">
                                            <div class="text-4xl font-black text-[#1f2a7a]">
                                                {{ number_format($promedio_dinamico, 2) }}
                                            </div>
                                            <div class="mt-1 text-xs uppercase tracking-[0.2em] text-gray-400">
                                                Promedio
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-6 flex flex-wrap gap-4 text-sm text-gray-500">
                                        <div class="flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-[#1f2a7a]"></span> Rendimiento</div>
                                        <div class="flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-[#22b8b2]"></span> Comportamiento</div>
                                        <div class="flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-[#ef4444]"></span> Pagos</div>
                                        <div class="flex items-center gap-2"><span class="h-3 w-3 rounded-full bg-[#e5e7eb]"></span> Referente</div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="rounded-2xl bg-gray-50 p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-700">Rendimiento Académico</div>
                                                <div class="text-xs text-gray-400">Puntaje: {{ number_format($rendimiento, 2) }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xl font-black text-[#1f2a7a]">{{ number_format($p1, 1) }}%</div>
                                                <div class="text-xs font-semibold text-[#1f2a7a]/60">Peso asignado</div>
                                            </div>
                                        </div>
                                        <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                                            <div class="h-2 rounded-full bg-[#1f2a7a]" style="width: {{ $p1 }}%"></div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl bg-gray-50 p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-700">Comportamiento e Identidad</div>
                                                <div class="text-xs text-gray-400">Puntaje: {{ number_format($comportamiento, 2) }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xl font-black text-[#22b8b2]">{{ number_format($p2, 1) }}%</div>
                                                <div class="text-xs font-semibold text-[#22b8b2]/80">Peso asignado</div>
                                            </div>
                                        </div>
                                        <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                                            <div class="h-2 rounded-full bg-[#22b8b2]" style="width: {{ $p2 }}%"></div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl bg-gray-50 p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-700">Puntualidad de Pagos</div>
                                                <div class="text-xs text-gray-400">Puntaje: {{ number_format($pagos, 2) }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xl font-black text-[#ef4444]">{{ number_format($p3, 1) }}%</div>
                                                <div class="text-xs font-semibold text-[#ef4444]/80">Peso asignado</div>
                                            </div>
                                        </div>
                                        <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                                            <div class="h-2 rounded-full bg-[#ef4444]" style="width: {{ $p3 }}%"></div>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl bg-gray-50 p-4">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-700">Alumnos Referentes</div>
                                                <div class="text-xs text-gray-400">Puntaje: {{ number_format($referente, 2) }}</div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xl font-black text-slate-500">{{ number_format($p4, 1) }}%</div>
                                                <div class="text-xs font-semibold text-slate-500">Peso asignado</div>
                                            </div>
                                        </div>
                                        <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                                            <div class="h-2 rounded-full bg-slate-500" style="width: {{ $p4 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-100 flex flex-col justify-between">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.25em] text-rose-500">
                                    Resumen de calificación
                                </p>

                                <div class="mt-3">
                                    <h3 class="text-2xl font-extrabold text-[#1f2a7a]">Puntaje Total Acumulado</h3>
                                    <p class="mt-2 text-sm leading-6 text-gray-500">
                                        Este puntaje es un promedio ponderado de tu desempeño académico, participación, puntualidad y liderazgo institucional.
                                    </p>
                                </div>
                            </div>

                            <div>
                                <div class="mt-6 rounded-3xl bg-[#f7f8ff] p-6 text-center">
                                    <div class="text-6xl font-black tracking-tight text-[#1f2a7a]">
                                        {{ number_format($promedio_dinamico, 2) }}
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
                                    <div class="font-semibold text-gray-700 mb-1">Detalles del Periodo</div>
                                    <div class="flex items-center justify-between border-b border-gray-100 pb-2 mb-2">
                                        <span class="text-xs text-gray-400">Ciclo Académico</span>
                                        <span class="font-medium text-gray-800">{{ $registro->semestre_estudiante ?? '—' }}° Semestre</span>                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-400">Periodo de Carga</span>
                                        <span class="inline-flex items-center rounded-md bg-indigo-100 px-2 py-0.5 text-xs font-bold text-indigo-800">
                                            {{ $periodo_nombre }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>