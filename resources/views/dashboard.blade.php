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
<body class="bg-surface text-on-surface overflow-x-hidden">

    @php
        $nombre = auth()->user()->name ?? 'Estudiante';
        $ranking = $registro->ranking ?? null;
        
        $rendimiento = $registro->rendimiento ?? 0;
        $comportamiento = $registro->comportamiento ?? 0;
        $pagos = $registro->pagos ?? 0;
        $referente = $registro->referente ?? 0;
        
        $semestre_objeto = $registro->semestre ?? null;
        $semestre = $semestre_objeto->nombre ?? '—';
        $periodo_nombre = $semestre;

        $peso_dinamico_db = $semestre_objeto->peso ?? null;

        $estado = $ranking !== null && $ranking <= 5 ? 'Top 5%' : 'Ranking General';

        $w1 = $peso_dinamico_db->rendimiento ?? 0.35;
        $w2 = $peso_dinamico_db->comportamiento ?? 0.35;
        $w3 = $peso_dinamico_db->pagos ?? 0.15;
        $w4 = $peso_dinamico_db->referente ?? 0.15;

        // --- LÓGICA GRÁFICO 1 (PESOS Y ESCALA BASE) ---
        $p1 = $w1 * 100;
        $p2 = $w2 * 100;
        $p3 = $w3 * 100;
        $p4 = $w4 * 100;

        $c1 = $p1;
        $c2 = $p1 + $p2;
        $c3 = $p1 + $p2 + $p3;

        $promedio_dinamico = ($rendimiento * $w1) + ($comportamiento * $w2) + ($pagos * $w3) + ($referente * $w4);

        // --- LÓGICA GRÁFICO 2 (NOTAS ESCALA VIGESIMAL 0-20) ---
        $nota_rendimiento = $rendimiento / 100;
        $nota_comportamiento = $comportamiento / 100;
        $nota_pagos = $pagos / 100;
        $nota_referente = $referente / 100;
        $promedio_20 = $promedio_dinamico / 100;

        // Porcentajes de logro sobre 20
        $pct_rendimiento = ($nota_rendimiento / 20) * 100;
        $pct_comportamiento = ($nota_comportamiento / 20) * 100;
        $pct_pagos = ($nota_pagos / 20) * 100;
        $pct_referente = ($nota_referente / 20) * 100;

        // Puntos aportados al total
        $puntos_r = $nota_rendimiento * $w1;
        $puntos_c = $nota_comportamiento * $w2;
        $puntos_p = $nota_pagos * $w3;
        $puntos_ref = $nota_referente * $w4;
        
        $total_pts = $puntos_r + $puntos_c + $puntos_p + $puntos_ref;

        if ($total_pts > 0) {
            $cg1 = ($puntos_r / $total_pts) * 100;
            $cg2 = $cg1 + (($puntos_c / $total_pts) * 100);
            $cg3 = $cg2 + (($puntos_p / $total_pts) * 100);
        } else {
            $cg1 = $p1; $cg2 = $p1 + $p2; $cg3 = $p1 + $p2 + $p3;
        }
    @endphp

    <div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/50 z-40 hidden lg:hidden transition-opacity"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-100 dark:bg-slate-900 flex flex-col py-8 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl lg:shadow-none">
        <div class="px-6 mb-10 flex justify-between items-center">
            <div>
                <h1 class="font-[Manrope] font-black text-[#001360] dark:text-blue-200 text-xl tracking-tight">Curador Académico</h1>
                <p class="text-xs font-label uppercase tracking-widest text-outline mt-1">Portal Institucional</p>
            </div>
            <button id="close-sidebar" class="lg:hidden text-outline hover:text-primary">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <nav class="flex-1 space-y-1">
            <a class="flex items-center border-l-4 border-[#001360] bg-slate-200/50 dark:bg-slate-800/50 text-[#001360] dark:text-blue-300 font-bold px-6 py-4 transition-all duration-200 group" href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="home" style="font-variation-settings: 'FILL' 1;">home</span>
                Mi Ranking
            </a>
            <a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" 
               href="{{ route('historial.index') }}">
                <span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="history">history</span>
                Historial
            </a>
        </nav>
        
        <div class="px-6 mt-auto">
            <form method="POST" action="{{ route('logout') }}" class="mb-4">
                @csrf
                <button type="submit" class="flex w-full items-center text-rose-500 font-semibold py-2 text-sm hover:text-rose-700 transition-colors">
                    <span class="material-symbols-outlined mr-2">logout</span> Cerrar sesión
                </button>
            </form>
            <div class="pt-4 border-t border-outline-variant/20 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold">
                    {{ strtoupper(substr($nombre, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-on-surface truncate w-32">{{ $nombre }}</p>
                    <p class="text-xs text-outline">Estudiante</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="w-full lg:ml-64 lg:w-[calc(100%-16rem)] min-h-screen transition-all duration-300">
        
        <header class="w-full sticky top-0 z-30 bg-[#fbf8ff]/90 backdrop-blur-md border-b border-outline-variant/10 flex justify-between items-center px-4 sm:px-8 lg:px-12 py-4 lg:py-6">
            <div class="flex items-center gap-3">
                <button id="open-sidebar" class="lg:hidden text-primary p-1 -ml-1">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
                <div class="flex flex-col">
                    <h2 class="font-[Manrope] font-extrabold text-[#001360] dark:text-blue-100 text-lg sm:text-2xl tracking-tight">Mi Rendimiento</h2>
                    <p class="hidden sm:block text-sm font-label text-outline">Consolidado Académico Personal</p>
                </div>
            </div>
            
            <div class="flex items-center gap-2 sm:gap-6">
                <span class="inline-flex items-center rounded-xl bg-primary/10 px-3 py-1.5 sm:px-4 sm:py-2 text-[10px] sm:text-xs font-bold text-primary ring-1 ring-inset ring-primary/20">
                    Periodo {{ $periodo_nombre }}
                </span>
            </div>
        </header>

        <div class="px-4 sm:px-8 lg:px-12 py-6 lg:py-8 bg-surface-container-low min-h-[calc(100vh-80px)] space-y-6 lg:space-y-8 relative">
            
            <section class="bg-surface-container-lowest rounded-xl p-5 sm:p-8 shadow-sm ring-1 ring-outline-variant/15">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-secondary">PANEL ESTUDIANTIL</p>
                        <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold tracking-tight text-primary">
                            Bienvenido, {{ explode(' ', trim($nombre))[0] }}
                        </h1>
                        <p class="mt-2 text-sm text-outline leading-relaxed">
                            Aquí puedes auditar tu desempeño ponderado en tiempo real basado en los criterios y pesos estipulados por el cuerpo editorial del Curador Académico.
                        </p>
                    </div>

                    <div class="w-full lg:max-w-xs rounded-xl bg-surface-container-low p-5 sm:p-6 text-center ring-1 ring-outline-variant/10 flex flex-col items-center">
                        <p class="text-xs font-bold uppercase tracking-wider text-outline">Posición en Escalafón</p>
                        <div class="mt-2 text-4xl sm:text-5xl font-black tracking-tight text-primary">
                            #{{ $ranking ?? '—' }}
                        </div>
                        <p class="mt-1 text-xs text-outline font-label">Rendimiento General</p>
                        <span class="mt-3 inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">
                            {{ $estado }}
                        </span>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-6 xl:grid-cols-[1.2fr_0.8fr] items-start">
                
                <div class="flex flex-col gap-6">
                    
                    <div class="rounded-xl bg-surface-container-lowest p-5 sm:p-8 shadow-sm ring-1 ring-outline-variant/15 space-y-6">
                        <h3 class="text-lg font-bold text-on-surface">Distribución de Pesos Ponderados</h3>
                        
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-[auto_1fr] items-center justify-items-center md:justify-items-start">
                            
                            <div class="mx-auto flex h-48 w-48 sm:h-60 sm:w-60 items-center justify-center rounded-full shadow-inner relative flex-shrink-0 transition-all"
                                 style="background: conic-gradient(#001360 0% {{ $c1 }}%, #4adbcf {{ $c1 }}% {{ $c2 }}%, #ba1a1a {{ $c2 }}% {{ $c3 }}%, #e3e1eb {{ $c3 }}% 100%);">
                                
                                <div class="flex h-32 w-32 sm:h-40 sm:w-40 flex-col items-center justify-center rounded-full bg-surface-container-lowest shadow-md transition-all">
                                    <div class="text-3xl sm:text-4xl font-black text-primary">
                                        {{ number_format($promedio_dinamico, 2) }}
                                    </div>
                                    <div class="mt-0.5 text-[10px] uppercase tracking-widest text-outline font-semibold">
                                        Promedio
                                    </div>
                                </div>
                            </div>

                            <div class="w-full space-y-4">
                                <div class="bg-surface-container-low p-4 rounded-xl ring-1 ring-outline-variant/5">
                                    <div class="flex items-center justify-between text-sm">
                                        <div>
                                            <div class="font-bold text-on-surface text-sm sm:text-base">Rendimiento Académico</div>
                                            <div class="text-xs text-outline font-data">Nota base: {{ number_format($rendimiento, 2) }}</div>
                                        </div>
                                        <div class="text-right"><div class="font-black text-primary">{{ number_format($p1, 1) }}%</div></div>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-surface-container-highest">
                                        <div class="h-2 rounded-full bg-[#001360]" style="width: {{ $p1 }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-surface-container-low p-4 rounded-xl ring-1 ring-outline-variant/5">
                                    <div class="flex items-center justify-between text-sm">
                                        <div>
                                            <div class="font-bold text-on-surface text-sm sm:text-base">Comportamiento e Identidad</div>
                                            <div class="text-xs text-outline font-data">Nota base: {{ number_format($comportamiento, 2) }}</div>
                                        </div>
                                        <div class="text-right"><div class="font-black text-[#00afa5]">{{ number_format($p2, 1) }}%</div></div>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-surface-container-highest">
                                        <div class="h-2 rounded-full bg-[#4adbcf]" style="width: {{ $p2 }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-surface-container-low p-4 rounded-xl ring-1 ring-outline-variant/5">
                                    <div class="flex items-center justify-between text-sm">
                                        <div>
                                            <div class="font-bold text-on-surface text-sm sm:text-base">Puntualidad de Pagos</div>
                                            <div class="text-xs text-outline font-data">Nota base: {{ number_format($pagos, 2) }}</div>
                                        </div>
                                        <div class="text-right"><div class="font-black text-[#ba1a1a]">{{ number_format($p3, 1) }}%</div></div>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-surface-container-highest">
                                        <div class="h-2 rounded-full bg-[#ba1a1a]" style="width: {{ $p3 }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-surface-container-low p-4 rounded-xl ring-1 ring-outline-variant/5">
                                    <div class="flex items-center justify-between text-sm">
                                        <div>
                                            <div class="font-bold text-on-surface text-sm sm:text-base">Alumnos Referentes</div>
                                            <div class="text-xs text-outline font-data">Nota base: {{ number_format($referente, 2) }}</div>
                                        </div>
                                        <div class="text-right"><div class="font-black text-outline">{{ number_format($p4, 1) }}%</div></div>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-surface-container-highest">
                                        <div class="h-2 rounded-full bg-outline-variant" style="width: {{ $p4 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl bg-surface-container-lowest p-5 sm:p-8 shadow-sm ring-1 ring-outline-variant/15 space-y-6">
                        <h3 class="text-lg font-bold text-on-surface">Métricas de Logro (Escala Vigesimal)</h3>
                        
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-[auto_1fr] items-center justify-items-center md:justify-items-start">
                            
                            <div class="mx-auto flex h-48 w-48 sm:h-60 sm:w-60 items-center justify-center rounded-full shadow-inner relative flex-shrink-0 transition-all"
                                 style="background: conic-gradient(#001360 0% {{ $cg1 }}%, #4adbcf {{ $cg1 }}% {{ $cg2 }}%, #ba1a1a {{ $cg2 }}% {{ $cg3 }}%, #e3e1eb {{ $cg3 }}% 100%);">
                                
                                <div class="flex h-32 w-32 sm:h-40 sm:w-40 flex-col items-center justify-center rounded-full bg-surface-container-lowest shadow-md transition-all">
                                    <div class="text-3xl sm:text-4xl font-black text-primary">
                                        {{ number_format($promedio_20, 2) }}
                                    </div>
                                    <div class="mt-0.5 text-[10px] uppercase tracking-widest text-outline font-semibold">
                                        / 20.00 Puntos
                                    </div>
                                </div>
                            </div>

                            <div class="w-full space-y-4">
                                <div class="bg-surface-container-low p-4 rounded-xl ring-1 ring-outline-variant/5">
                                    <div class="flex items-center justify-between text-sm">
                                        <div>
                                            <div class="font-bold text-on-surface text-sm sm:text-base">Rendimiento Académico</div>
                                            <div class="text-xs text-outline font-data">Nota: {{ number_format($nota_rendimiento, 2) }} / 20.00</div>
                                        </div>
                                        <div class="text-right"><div class="font-black text-primary">{{ number_format($pct_rendimiento, 1) }}% Logro</div></div>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-surface-container-highest">
                                        <div class="h-2 rounded-full bg-[#001360]" style="width: {{ $pct_rendimiento }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-surface-container-low p-4 rounded-xl ring-1 ring-outline-variant/5">
                                    <div class="flex items-center justify-between text-sm">
                                        <div>
                                            <div class="font-bold text-on-surface text-sm sm:text-base">Comportamiento e Identidad</div>
                                            <div class="text-xs text-outline font-data">Nota: {{ number_format($nota_comportamiento, 2) }} / 20.00</div>
                                        </div>
                                        <div class="text-right"><div class="font-black text-[#00afa5]">{{ number_format($pct_comportamiento, 1) }}% Logro</div></div>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-surface-container-highest">
                                        <div class="h-2 rounded-full bg-[#4adbcf]" style="width: {{ $pct_comportamiento }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-surface-container-low p-4 rounded-xl ring-1 ring-outline-variant/5">
                                    <div class="flex items-center justify-between text-sm">
                                        <div>
                                            <div class="font-bold text-on-surface text-sm sm:text-base">Puntualidad de Pagos</div>
                                            <div class="text-xs text-outline font-data">Nota: {{ number_format($nota_pagos, 2) }} / 20.00</div>
                                        </div>
                                        <div class="text-right"><div class="font-black text-[#ba1a1a]">{{ number_format($pct_pagos, 1) }}% Logro</div></div>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-surface-container-highest">
                                        <div class="h-2 rounded-full bg-[#ba1a1a]" style="width: {{ $pct_pagos }}%"></div>
                                    </div>
                                </div>

                                <div class="bg-surface-container-low p-4 rounded-xl ring-1 ring-outline-variant/5">
                                    <div class="flex items-center justify-between text-sm">
                                        <div>
                                            <div class="font-bold text-on-surface text-sm sm:text-base">Alumnos Referentes</div>
                                            <div class="text-xs text-outline font-data">Nota: {{ number_format($nota_referente, 2) }} / 20.00</div>
                                        </div>
                                        <div class="text-right"><div class="font-black text-outline">{{ number_format($pct_referente, 1) }}% Logro</div></div>
                                    </div>
                                    <div class="mt-2 h-2 w-full rounded-full bg-surface-container-highest">
                                        <div class="h-2 rounded-full bg-outline-variant" style="width: {{ $pct_referente }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="rounded-xl bg-surface-container-lowest p-5 sm:p-8 shadow-sm ring-1 ring-outline-variant/15 flex flex-col gap-8 h-fit sticky top-28">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-outline">RESUMEN MÉTRICO</p>
                        <h3 class="mt-1 text-xl font-extrabold text-primary">Puntaje Acumulado</h3>
                        <p class="mt-2 text-xs text-outline leading-relaxed">
                            Cálculo definitivo de la nota final escalada a la métrica nacional estándar de 0.00 a 20.00 puntos.
                        </p>

                        <div class="mt-6 rounded-2xl bg-surface-container-low p-6 text-center ring-1 ring-outline-variant/5">
                            <div class="text-5xl sm:text-6xl font-black tracking-tight text-primary">
                                {{ number_format($promedio_20, 2) }}
                            </div>
                            <div class="mt-1 text-xs font-bold text-outline uppercase tracking-wider">/ 20.00 puntos</div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="rounded-xl bg-emerald-50 p-4 ring-1 ring-emerald-500/10">
                            <div class="text-xs font-bold text-emerald-800 uppercase tracking-wide">Estado de elegibilidad</div>
                            <div class="mt-0.5 text-sm text-emerald-700 font-medium leading-tight">
                                {{ $ranking !== null && $ranking <= 5 ? 'Elegible para beneficios de excelencia institucional' : 'En seguimiento académico regular' }}
                            </div>
                        </div>

                        <div class="rounded-xl bg-surface-container-low p-4 text-xs space-y-2 text-on-surface ring-1 ring-outline-variant/10">
                            <div class="flex items-center justify-between border-b border-outline-variant/20 pb-2">
                                <span class="text-outline">Ciclo de Estudios</span>
                                <span class="font-bold text-primary">{{ $registro->semestre_estudiante ?? '—' }}° Semestre</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-outline">Periodo de Carga</span>
                                <span class="font-bold text-[#001360] font-data">{{ $periodo_nombre }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main>

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