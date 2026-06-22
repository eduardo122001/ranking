<!DOCTYPE html>  
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Historial Académico | Curador Académico</title>
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
        $nombre = auth()->user()->name ?? 'Estudiante';
    @endphp

    <div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/40 z-40 hidden lg:hidden transition-opacity backdrop-blur-sm"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-100 dark:bg-slate-900 flex flex-col py-8 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out border-r border-slate-200/50">
        
        <div class="px-4 mb-8 relative w-full flex flex-col gap-4">
            <button id="close-sidebar" class="absolute top-0 right-2 lg:hidden text-outline hover:text-primary p-2 rounded-lg hover:bg-slate-200/50 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            
            <div class="w-full px-2">
                <img src="{{ asset('images/cedhi.png') }}" alt="CEDHI Logo" class="w-full h-auto max-h-40 object-contain block mx-auto">
            </div>
            
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
            <a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-4 py-3.5 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 rounded-xl transition-all duration-200 group" 
               href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined mr-3 group-hover:scale-105 transition-transform" data-icon="home">home</span>
                Mi Ranking
            </a>
            <a class="flex items-center bg-white dark:bg-slate-800 text-[#001360] dark:text-blue-300 font-bold px-4 py-3.5 shadow-sm transition-all duration-200 group border border-slate-200/40" 
               href="{{ route('historial.index') }}">
                <span class="material-symbols-outlined mr-3 text-[#001360] group-hover:scale-105 transition-transform" data-icon="history" style="font-variation-settings: 'FILL' 1;">history</span>
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

    <main class="w-full lg:ml-64 lg:w-[calc(100%-16rem)] min-h-screen transition-all duration-300">
        
        <header class="w-full sticky top-0 z-30 bg-[#fbf8ff]/80 backdrop-blur-md border-b border-slate-200/50 flex justify-between items-center px-4 sm:px-8 lg:px-10 py-4">
            <div class="flex items-center gap-3">
                <button id="open-sidebar" class="lg:hidden text-primary p-2 rounded-xl bg-slate-100 hover:bg-slate-200 active:scale-95 transition-all">
                    <span class="material-symbols-outlined text-2xl vertical-middle">menu</span>
                </button>
                <div>
                    <h2 class="font-display font-extrabold text-[#001360] dark:text-blue-100 text-lg sm:text-2xl tracking-tight">Historial Académico</h2>
                    <p class="hidden sm:block text-xs text-outline font-medium">Consulta el registro histórico de tus métricas por semestres</p>
                </div>
            </div>
        </header>

        <div class="px-4 sm:px-8 lg:px-10 py-6 lg:py-8 bg-surface-container-low min-h-[calc(100vh-73px)] space-y-6 lg:space-y-8">
            
            <section class="bg-white rounded-2xl p-5 sm:p-8 border border-slate-200/60 shadow-sm transition-all hover:shadow-md/50 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="max-w-2xl">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-secondary bg-rose-50 px-2.5 py-1 rounded-md">PORTAL ESTUDIANTIL / HISTORIAL ACADÉMICO</span>
                    <h1 class="mt-3 text-2xl sm:text-3xl font-extrabold tracking-tight text-[#001360]">Resumen de Trayectoria</h1>
                    <p class="mt-2 text-sm text-outline leading-relaxed font-normal">
                        Consulta el registro histórico de tus métricas de desempeño y posicionamiento en el ranking institucional a través de los semestres.
                    </p>
                </div>

                <div class="inline-block min-w-[280px] rounded-xl bg-slate-50/80 p-5 sm:p-6 border border-slate-200/40 self-start md:self-center">
                    <p class="text-xs font-bold uppercase tracking-wider text-outline">Promedio Histórico</p>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-4xl sm:text-5xl font-black tracking-tight text-[#001360]">{{ number_format($promedioHistorico, 2) }}</span>
                        <span class="text-sm font-bold text-outline uppercase tracking-wider font-data">/ 20.00</span>
                    </div>
                    
                </div>
            </section>

            <section class="space-y-6">
                <div class="flex items-center gap-2 text-[#001360] font-bold text-lg mb-2">
                    <span class="material-symbols-outlined">calendar_month</span>
                    <h3>Detalle por Periodo Académico</h3>
                </div>

                @forelse($historial as $index => $item)
                    @php
                        $nombreCiclo = is_object($item->semestre) ? $item->semestre->nombre : $item->semestre;
                        
                        // =========================================================
                        // CAMBIO INTEGRAL: MAPEO DIRECTO EN ESCALA DE 0 A 20
                        // =========================================================
                        $nota_rendimiento = $item->rendimiento ?? 0;
                        $nota_comportamiento = $item->comportamiento ?? 0;
                        $nota_pagos = $item->pagos ?? 0;
                        $nota_referente = $item->referente ?? 0;

                        $nota_20 = $item->final_score ?? 0;
                        
                        // Porcentaje basado en el tope máximo vigesimal de 20 puntos
                        $pct_total_logro = $nota_20 > 0 ? ($nota_20 / 20) * 100 : 0;
                    @endphp
                    
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden grid grid-cols-1 lg:grid-cols-[220px_1fr_180px] min-h-[140px]">
                        
                        <div class="{{ $index === 0 ? 'bg-[#001360] text-white' : 'bg-slate-100 text-on-surface' }} p-6 flex flex-col justify-center items-center text-center border-b lg:border-b-0 lg:border-r border-slate-200/40">
                            <span class="text-xs uppercase tracking-wider {{ $index === 0 ? 'text-slate-300' : 'text-outline' }} font-bold">Semestre</span>
                            <span class="text-3xl font-black tracking-tight mt-1">{{ $nombreCiclo }}</span> 
                            
                            <div class="mt-4 flex flex-col gap-1.5 items-center w-full">
                                <span class="inline-flex items-center justify-center rounded-lg {{ $index === 0 ? 'bg-white/10 text-white' : 'bg-[#001360]/10 text-[#001360]' }} px-3 py-1.5 text-sm font-black tracking-wide border {{ $index === 0 ? 'border-white/20' : 'border-[#001360]/20' }} w-full max-w-[160px]">
                                    Nota: {{ number_format($nota_20, 2) }}
                                </span>
                                <span class="text-[11px] font-bold uppercase tracking-wider {{ $index === 0 ? 'text-slate-300' : 'text-emerald-700' }}">
                                    Logro: {{ number_format($pct_total_logro, 1) }}%
                                </span>
                            </div>
                        </div>

                        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 items-center bg-white">
                            
                            <div class="bg-slate-50/50 border border-slate-100 p-3.5 rounded-xl space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[10px] font-bold text-outline uppercase tracking-wider truncate">Rendimiento</span>
                                    <span class="text-xs font-black text-primary bg-primary/5 px-2 py-0.5 rounded-md">{{ number_format($item->peso_rendimiento ?? 35, 1) }}%</span>
                                </div>
                                <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-1.5 bg-[#001360] rounded-full" style="width: {{ $item->peso_rendimiento ?? 35 }}%"></div>
                                </div>
                                <p class="text-[11px] font-medium text-on-surface/80 font-data pt-0.5">
                                    Nota: <span class="font-bold text-primary">{{ number_format($nota_rendimiento, 2) }} / 20.00</span>
                                </p>
                            </div>

                            <div class="bg-slate-50/50 border border-slate-100 p-3.5 rounded-xl space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[10px] font-bold text-outline uppercase tracking-wider truncate">Comportamiento</span>
                                    <span class="text-xs font-black text-[#00afa5] bg-emerald-50 px-2 py-0.5 rounded-md">{{ number_format($item->peso_comportamiento ?? 35, 1) }}%</span>
                                </div>
                                <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-1.5 bg-[#4adbcf] rounded-full" style="width: {{ $item->peso_comportamiento ?? 35 }}%"></div>
                                </div>
                                <p class="text-[11px] font-medium text-on-surface/80 font-data pt-0.5">
                                    Nota: <span class="font-bold text-slate-800">{{ number_format($nota_comportamiento, 2) }} / 20.00</span>
                                </p>
                            </div>

                            <div class="bg-slate-50/50 border border-slate-100 p-3.5 rounded-xl space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[10px] font-bold text-outline uppercase tracking-wider truncate">Puntualidad</span>
                                    <span class="text-xs font-black text-[#ba1a1a] bg-rose-50 px-2 py-0.5 rounded-md">{{ number_format($item->peso_pagos ?? 15, 1) }}%</span>
                                </div>
                                <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-1.5 bg-[#ba1a1a] rounded-full" style="width: {{ $item->peso_pagos ?? 15 }}%"></div>
                                </div>
                                <p class="text-[11px] font-medium text-on-surface/80 font-data pt-0.5">
                                    Nota: <span class="font-bold text-slate-800">{{ number_format($nota_pagos, 2) }} / 20.00</span>
                                </p>
                            </div>

                            <div class="bg-slate-50/50 border border-slate-100 p-3.5 rounded-xl space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[10px] font-bold text-outline uppercase tracking-wider truncate">Referentes</span>
                                    <span class="text-xs font-black text-slate-700 bg-slate-100 px-2 py-0.5 rounded-md">{{ number_format($item->peso_referente ?? 15, 1) }}%</span>
                                </div>
                                <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-1.5 bg-outline-variant" style="width: {{ $item->peso_referente ?? 15 }}%"></div>
                                </div>
                                <p class="text-[11px] font-medium text-on-surface/80 font-data pt-0.5">
                                    Nota: <span class="font-bold text-slate-800">{{ number_format($nota_referente, 2) }} / 20.00</span>
                                </p>
                            </div>
                        </div>

                        <div class="bg-slate-50/70 p-6 flex flex-col justify-center items-center text-center border-t lg:border-t-0 lg:border-l border-slate-200/40">
                            <span class="text-xs uppercase tracking-wider text-outline font-bold">Ranking</span>
                            <span class="text-4xl font-black text-primary tracking-tight mt-0.5">#{{ $item->ranking ?? '—' }}</span>
                            
                        </div>

                    </div>
                @empty
                    <div class="bg-white rounded-xl p-12 text-center text-outline border border-slate-200/60 shadow-sm">
                        <span class="material-symbols-outlined text-4xl text-outline/50 mb-2">folder_open</span>
                        <p class="font-medium">No se encontraron registros académicos cargados en tu historial.</p>
                    </div>
                @endforelse
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