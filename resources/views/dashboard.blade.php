<!DOCTYPE html> 
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Mi Ranking | Curador Académico</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&family=Public+Sans:wght@400;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Manrope', sans-serif; }
        .font-data { font-family: 'Public Sans', sans-serif; }
        
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e3e1eb; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #757684; }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-fixed-dim": "#4adbcf", "on-surface-variant": "#444653", "tertiary": "#002421",
                        "surface-container": "#eeedf6", "surface": "#fbf8ff", "secondary": "#b61900",
                        "surface-container-highest": "#e3e1eb", "inverse-primary": "#bac3ff", "primary": "#001360",
                        "on-background": "#1a1b22", "on-primary": "#ffffff", "secondary-fixed": "#ffdad3",
                        "tertiary-container": "#003b37", "surface-tint": "#3e54c1", "error-container": "#ffdad6",
                        "outline": "#757684", "on-surface": "#1a1b22", "error": "#ba1a1a",
                        "outline-variant": "#c5c5d5", "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f4f2fc", "background": "#fbf8ff"
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-on-surface overflow-x-hidden antialiased">

    @php
        $nombre = auth()->user()->name ?? 'Juanito';
        $ranking = $registro->ranking ?? 1;
        
        $rendimiento = $registro->rendimiento ?? 0; 
        $comportamiento = $registro->comportamiento ?? 0;
        $pagos = $registro->pagos ?? 0;
        $referente = $registro->referente ?? 0;
        
        $semestre_objeto = $registro->semestre ?? null;
        $semestre = $semestre_objeto->nombre ?? '2025-1';
        $periodo_nombre = $semestre;

        $peso_dinamico_db = $semestre_objeto->peso ?? null;

        $carrera = $registro->carrera;
        $carrera_nombre = $registro->carrera->nombre ?? 'Sin carrera';

        $estado = $ranking !== null && $ranking <= 5 ? '' : 'Ranking General';

        $w1 = $peso_dinamico_db->rendimiento ?? 0.35;
        $w2 = $peso_dinamico_db->comportamiento ?? 0.35;
        $w3 = $peso_dinamico_db->pagos ?? 0.15;
        $w4 = $peso_dinamico_db->referente ?? 0.15;

        $p1 = $w1 * 100;
        $p2 = $w2 * 100;
        $p3 = $w3 * 100;
        $p4 = $w4 * 100;

        $c1 = $p1;
        $c2 = $p1 + $p2;
        $c3 = $p1 + $p2 + $p3;

        $promedio_dinamico = ($rendimiento * $w1) + ($comportamiento * $w2) + ($pagos * $w3) + ($referente * $w4);

        $nota_rendimiento = 12.00; 
        $nota_comportamiento = 19.00;
        $nota_pagos = 16.00;
        $nota_referente = 18.00;
        $promedio_20 = 15.95;

        $pct_rendimiento = 60.0;
        $pct_comportamiento = 95.0;
        $pct_pagos = 80.0;
        $pct_referente = 90.0;
        $pct_total_logro = 79.8;
    @endphp

    <div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/40 z-40 hidden lg:hidden transition-opacity backdrop-blur-sm"></div>

    <!-- Barra Lateral Izquierda -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-100 dark:bg-slate-900 flex flex-col py-8 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out border-r border-slate-200/50">
        
        <!-- Cabecera con Logo al Máximo Ancho Posible -->
        <div class="px-4 mb-8 relative w-full flex flex-col gap-4">
            
            <!-- Botón de cerrar flotante a la derecha (solo móvil) para que no empuje ni reduzca el tamaño del logo -->
            <button id="close-sidebar" class="absolute top-0 right-2 lg:hidden text-outline hover:text-primary p-2 rounded-lg hover:bg-slate-200/50 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            
            <!-- Contenedor del Logo expandido al 100% del ancho del menú -->
            <div class="w-full px-2">
                <img src="{{ asset('images/cedhi.png') }}" alt="CEDHI Logo" class="w-full h-auto max-h-40 object-contain block mx-auto">
            </div>
            
            <!-- Título identificador inferior -->
            <div class="px-2 border-t border-slate-200/60 pt-3">
                <h1 class="font-display font-extrabold text-[#001360] dark:text-blue-200 text-xl tracking-tight leading-tight">
                    Curador Académico
                </h1>
                <p class="text-[10px] font-semibold uppercase tracking-widest text-outline mt-1">
                    Portal Institucional
                </p>
            </div>
        </div>
        
        <nav class="flex-1 space-y-1 px-3">
            <a class="flex items-center rounded-xl bg-white dark:bg-slate-800 text-[#001360] dark:text-blue-300 font-bold px-4 py-3.5 shadow-sm transition-all duration-200 group border border-slate-200/40" 
               href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined mr-3 text-[#001360] group-hover:scale-105 transition-transform" style="font-variation-settings: 'FILL' 1;">home</span>
                Mi Ranking
            </a>
            <a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-4 py-3.5 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-xl transition-all duration-200 group" 
               href="{{ route('historial.index') }}">
                <span class="material-symbols-outlined mr-3 group-hover:scale-105 transition-transform">history</span>
                Historial
            </a>
        </nav>
        
        <div class="px-6 mt-auto space-y-4">
            <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-200/60 pt-4">
                @csrf
                <button type="submit" class="flex w-full items-center text-rose-500 font-semibold py-2.5 text-sm hover:text-rose-700 transition-colors rounded-xl hover:bg-rose-50/50 px-2">
                    <span class="material-symbols-outlined mr-2">logout</span> Cerrar sesión
                </button>
            </form>
            <div class="pt-2 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#001360]/10 text-[#001360] flex items-center justify-center font-bold text-sm">
                    {{ strtoupper(substr($nombre, 0, 1)) }}
                </div>
                <div class="truncate">
                    <p class="text-sm font-bold text-on-surface truncate w-36">{{ $nombre }}</p>
                    <p class="text-[11px] text-outline font-medium">Estudiante</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Contenedor Principal -->
    <main class="w-full lg:ml-64 lg:w-[calc(100%-16rem)] min-h-screen transition-all duration-300">
        
        <!-- Header -->
        <header class="w-full sticky top-0 z-30 bg-[#fbf8ff]/80 backdrop-blur-md border-b border-slate-200/50 flex justify-between items-center px-4 sm:px-8 lg:px-10 py-4">
            <div class="flex items-center gap-3">
                <button id="open-sidebar" class="lg:hidden text-primary p-2 rounded-xl bg-slate-100 hover:bg-slate-200 active:scale-95 transition-all">
                    <span class="material-symbols-outlined text-2xl vertical-middle">menu</span>
                </button>
                <div>
                    <h2 class="font-display font-extrabold text-[#001360] text-lg sm:text-2xl tracking-tight">Mi Rendimiento</h2>
                    <p class="hidden sm:block text-xs text-outline font-medium">Consolidado Académico Personal</p>
                </div>
            </div>
            
            <div>
                <span class="inline-flex items-center rounded-xl bg-[#001360]/5 px-3.5 py-2 text-xs font-bold text-[#001360] border border-[#001360]/10 font-data">
                    Periodo {{ $periodo_nombre }}
                </span>
            </div>
        </header>

        <!-- Contenido Base -->
        <div class="px-4 sm:px-8 lg:px-10 py-6 lg:py-8 bg-surface-container-low min-h-[calc(100vh-73px)] space-y-6 lg:space-y-8">
            
            <!-- Banner de Bienvenida -->
            <section class="bg-white rounded-2xl p-5 sm:p-8 border border-slate-200/60 shadow-sm transition-all hover:shadow-md/50">
                <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div class="max-w-2xl">
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-secondary bg-rose-50 px-2.5 py-1 rounded-md">PANEL ESTUDIANTIL</span>
                        <h1 class="mt-3 text-2xl sm:text-3xl font-extrabold tracking-tight text-[#001360]">
                            Bienvenido, {{ explode(' ', trim($nombre))[0] }}
                        </h1>
                        <p class="mt-2 text-sm text-outline leading-relaxed font-normal">
                            Aquí puedes auditar tu desempeño ponderado en tiempo real basado en los criterios y pesos estipulados por el cuerpo editorial del Curador Académico.
                        </p>
                    </div>

                    <div class="w-full md:w-64 rounded-xl bg-slate-50/80 p-4 sm:p-5 text-center border border-slate-200/40 flex flex-col items-center justify-center">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-outline">Posición en Escalafón</p>
                        <div class="mt-1.5 text-4xl sm:text-5xl font-black tracking-tight text-[#001360]">
                            #{{ $ranking }}
                        </div>
                        <p class="mt-0.5 text-xs text-outline font-medium">Rendimiento General</p>
                        <span class="mt-3 inline-flex items-center rounded-full bg-emerald-100/80 px-3 py-1 text-xs font-bold text-emerald-700 border border-emerald-200/50">
                            {{ $estado }}
                        </span>
                    </div>
                </div>
            </section>

            <!-- Grid Principal -->
            <section class="grid grid-cols-1 gap-6 xl:grid-cols-3 items-start">
                
                <!-- Columna Izquierda: Gráficos -->
                <div class="xl:col-span-2 flex flex-col gap-6 lg:gap-8">
                    
                    <!-- 1. GRÁFICO DE LOGRO -->
                    <div class="rounded-2xl bg-white p-5 sm:p-8 border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-300 space-y-6">
                        <div class="border-b border-slate-100 pb-4">
                            <h3 class="text-xl font-extrabold text-[#001360]">Tu Progreso Actual</h3>
                            <p class="text-xs text-outline mt-1 font-medium">Porcentaje de logro alcanzado en cada criterio de evaluación</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-8 pt-2">
                            <!-- Dona de Logro -->
                            <div class="mx-auto flex h-44 w-44 sm:h-52 sm:w-52 items-center justify-center rounded-full shadow-inner relative flex-shrink-0 transition-all"
                                 style="background: conic-gradient(#001360 0% {{ $pct_total_logro }}%, #eeedf6 {{ $pct_total_logro }}% 100%);">
                                <div class="flex h-32 w-32 sm:h-38 sm:w-38 flex-col items-center justify-center rounded-full bg-white shadow-sm">
                                    <div class="text-2xl sm:text-3xl font-black text-[#001360]">
                                        {{ number_format($pct_total_logro, 1) }}%
                                    </div>
                                    <div class="text-[9px] uppercase tracking-widest text-outline font-bold mt-0.5">
                                        Logro Total
                                    </div>
                                </div>
                            </div>

                            <!-- Listado de Criterios -->
                            <div class="w-full space-y-3.5">
                                <div class="bg-slate-50/60 p-3.5 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <div>
                                            <div class="font-bold text-[#001360]">Rendimiento Académico</div>
                                            <div class="text-[11px] text-outline font-data mt-0.5">Nota: {{ number_format($nota_rendimiento, 2) }} / 20.00</div>
                                        </div>
                                        <span class="font-black text-[#001360] text-xs bg-white px-2 py-1 rounded-md border border-slate-200/40 shadow-2xs">{{ number_format($pct_rendimiento, 1) }}%</span>
                                    </div>
                                    <div class="mt-2.5 h-2 w-full rounded-full bg-slate-200/50 overflow-hidden">
                                        <div class="h-2 rounded-full bg-[#001360]" style="width: {{ $pct_rendimiento }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-slate-50/60 p-3.5 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <div>
                                            <div class="font-bold text-[#001360]">Comportamiento e Identidad</div>
                                            <div class="text-[11px] text-outline font-data mt-0.5">Nota: {{ number_format($nota_comportamiento, 2) }} / 20.00</div>
                                        </div>
                                        <span class="font-black text-[#001360] text-xs bg-white px-2 py-1 rounded-md border border-slate-200/40 shadow-2xs">{{ number_format($pct_comportamiento, 1) }}%</span>
                                    </div>
                                    <div class="mt-2.5 h-2 w-full rounded-full bg-slate-200/50 overflow-hidden">
                                        <div class="h-2 rounded-full bg-[#001360]" style="width: {{ $pct_comportamiento }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-slate-50/60 p-3.5 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <div>
                                            <div class="font-bold text-[#001360]">Puntualidad de Pagos</div>
                                            <div class="text-[11px] text-outline font-data mt-0.5">Nota: {{ number_format($nota_pagos, 2) }} / 20.00</div>
                                        </div>
                                        <span class="font-black text-[#001360] text-xs bg-white px-2 py-1 rounded-md border border-slate-200/40 shadow-2xs">{{ number_format($pct_pagos, 1) }}%</span>
                                    </div>
                                    <div class="mt-2.5 h-2 w-full rounded-full bg-slate-200/50 overflow-hidden">
                                        <div class="h-2 rounded-full bg-[#001360]" style="width: {{ $pct_pagos }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-slate-50/60 p-3.5 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <div>
                                            <div class="font-bold text-[#001360]">Alumnos Referentes</div>
                                            <div class="text-[11px] text-outline font-data mt-0.5">Nota: {{ number_format($nota_referente, 2) }} / 20.00</div>
                                        </div>
                                        <span class="font-black text-[#001360] text-xs bg-white px-2 py-1 rounded-md border border-slate-200/40 shadow-2xs">{{ number_format($pct_referente, 1) }}%</span>
                                    </div>
                                    <div class="mt-2.5 h-2 w-full rounded-full bg-slate-200/50 overflow-hidden">
                                        <div class="h-2 rounded-full bg-[#001360]" style="width: {{ $pct_referente }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. GRÁFICO DE PESOS -->
                    <div class="rounded-2xl bg-white p-5 sm:p-8 border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-300 space-y-6">
                        <div class="border-b border-slate-100 pb-4">
                            <h3 class="text-xl font-extrabold text-[#001360]">Ponderación del Periodo</h3>
                            <p class="text-xs text-outline mt-1 font-medium">Estructura porcentual de cuánto equivale cada aspecto en tu calificación</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-8 pt-2">
                            <!-- Dona de Pesos -->
                            <div class="mx-auto flex h-44 w-44 sm:h-52 sm:w-52 items-center justify-center rounded-full shadow-inner relative flex-shrink-0 transition-all"
                                 style="background: conic-gradient(#001360 0% {{ $c1 }}%, #00afa5 {{ $c1 }}% {{ $c2 }}%, #ba1a1a {{ $c2 }}% {{ $c3 }}%, #94a3b8 {{ $c3 }}% 100%);">
                                <div class="flex h-32 w-32 sm:h-38 sm:w-38 flex-col items-center justify-center rounded-full bg-white shadow-sm">
                                    <div class="text-2xl font-black text-[#001360]">
                                        Pesos
                                    </div>
                                </div>
                            </div>

                            <!-- Listado de Pesos -->
                            <div class="w-full space-y-3.5">
                                <div class="bg-slate-50/60 p-3.5 rounded-xl border border-slate-100">
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <div class="font-bold text-[#001360]">Rendimiento Académico</div>
                                        <span class="font-black text-[#001360]">{{ number_format($p1, 1) }}%</span>
                                    </div>
                                    <div class="mt-2.5 h-2 w-full rounded-full bg-slate-200/50 overflow-hidden">
                                        <div class="h-2 rounded-full bg-[#001360]" style="width: {{ $p1 }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-slate-50/60 p-3.5 rounded-xl border border-slate-100">
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <div class="font-bold text-[#001360]">Comportamiento e Identidad</div>
                                        <span class="font-black text-[#00afa5]">{{ number_format($p2, 1) }}%</span>
                                    </div>
                                    <div class="mt-2.5 h-2 w-full rounded-full bg-slate-200/50 overflow-hidden">
                                        <div class="h-2 rounded-full bg-[#00afa5]" style="width: {{ $p2 }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-slate-50/60 p-3.5 rounded-xl border border-slate-100">
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <div class="font-bold text-[#001360]">Puntualidad de Pagos</div>
                                        <span class="font-black text-[#ba1a1a]">{{ number_format($p3, 1) }}%</span>
                                    </div>
                                    <div class="mt-2.5 h-2 w-full rounded-full bg-slate-200/50 overflow-hidden">
                                        <div class="h-2 rounded-full bg-[#ba1a1a]" style="width: {{ $p3 }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-slate-50/60 p-3.5 rounded-xl border border-slate-100">
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <div class="font-bold text-[#001360]">Alumnos Referentes</div>
                                        <span class="font-black text-[#94a3b8]">{{ number_format($p4, 1) }}%</span>
                                    </div>
                                    <div class="mt-2.5 h-2 w-full rounded-full bg-slate-200/50 overflow-hidden">
                                        <div class="h-2 rounded-full bg-[#94a3b8]" style="width: {{ $p4 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Columna Derecha: Resumen Métrico -->
                <div class="rounded-2xl bg-white p-5 sm:p-8 border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col gap-6 lg:gap-8 xl:sticky xl:top-24">
                    <div>
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-outline bg-slate-100 px-2.5 py-1 rounded-md">RESUMEN MÉTRICO</span>
                        <h3 class="mt-4 text-xl font-extrabold text-[#001360]">Puntaje Acumulado</h3>
                        <p class="mt-2 text-xs text-outline leading-relaxed font-normal">
                            Cálculo definitivo de la nota final escalada a la métrica nacional estándar de 0.00 a 20.00 puntos.
                        </p>

                        <div class="mt-6 rounded-2xl bg-[#001360]/5 p-6 text-center border border-[#001360]/10 shadow-inner">
                            <div class="text-5xl sm:text-6xl font-black tracking-tight text-[#001360]">
                                {{ number_format($promedio_20, 1) }}
                            </div>
                            <div class="mt-1.5 text-[11px] font-bold text-outline uppercase tracking-wider font-data">/ 20.00 puntos</div>
                        </div>
                    </div>

                    <div class="space-y-3.5">
                        

                        <div class="rounded-xl bg-slate-50/80 p-4 text-xs space-y-2.5 text-on-surface border border-slate-200/30">
                            <div class="flex items-center justify-between border-b border-slate-200/40 pb-2.5">
                                <span class="text-outline font-medium">Carrera</span>
                                <span class="font-bold text-[#001360]">{{ $carrera_nombre }}</span>
                            </div>
                                <div class="flex items-center justify-between border-b border-slate-200/40 pb-2.5">
                                    <span class="text-outline font-medium">Semestre del estudiante: </span>
                                    <span class="font-bold text-[#001360]">
                                        {{ $registro->semestre_estudiante ? $registro->semestre_estudiante . '° Semestre' : 'No registrado' }}
                                    </span>
                                </div>
                            <div class="flex items-center justify-between">
                                <span class="text-outline font-medium">Periodo de Carga</span>
                                <span class="font-bold text-[#001360]" font-data>{{ $periodo_nombre }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>

    <!-- Script de Control Responsivo para Menú Lateral -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');

            function toggleMenu() {
                sidebar.classList.toggle('-translate-x-full');
                backdrop.classList.toggle('hidden');
            }

            openBtn.addEventListener('click', toggleMenu);
            closeBtn.addEventListener('click', toggleMenu);
            backdrop.addEventListener('click', toggleMenu);
        });
    </script>
</body>
</html>