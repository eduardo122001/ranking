<!DOCTYPE html> 

<html class="light" lang="es"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Usuarios | Curador Académico</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&amp;family=Inter:wght@400;500;600&amp;family=Public+Sans:wght@400;600&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        /*-----------------------------------------------------------------------------------*/
        /* OJO: ESTA ES LA PANTALLA PARA VER TODOS LOS USUARIOS, USADO EN SUPERADMINISTRADOR */
        /*-----------------------------------------------------------------------------------*/

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Manrope', sans-serif; }
        .font-data { font-family: 'Public Sans', sans-serif; }
        
        /* Custom scrollbar for webkit */
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
                    "colors": {
                        "tertiary-fixed-dim": "#4adbcf",
                        "on-surface-variant": "#444653",
                        "tertiary": "#002421",
                        "surface-container": "#eeedf6",
                        "surface": "#fbf8ff",
                        "secondary": "#b61900",
                        "surface-container-highest": "#e3e1eb",
                        "inverse-primary": "#bac3ff",
                        "primary": "#001360",
                        "on-background": "#1a1b22",
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#ffdad3",
                        "tertiary-container": "#003b37",
                        "surface-tint": "#3e54c1",
                        "error-container": "#ffdad6",
                        "secondary-fixed-dim": "#ffb4a5",
                        "on-secondary-fixed-variant": "#8f1100",
                        "on-tertiary-fixed": "#00201e",
                        "on-primary-container": "#8094ff",
                        "surface-container-low": "#f4f2fc",
                        "outline": "#757684",
                        "on-surface": "#1a1b22",
                        "error": "#ba1a1a",
                        "outline-variant": "#c5c5d5",
                        "inverse-on-surface": "#f1eff9",
                        "on-tertiary-fixed-variant": "#00504b",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed-variant": "#223aa8",
                        "surface-bright": "#fbf8ff",
                        "surface-dim": "#dad9e3",
                        "surface-container-high": "#e9e7f1",
                        "secondary-container": "#e22707",
                        "on-tertiary-container": "#00afa5",
                        "background": "#fbf8ff",
                        "surface-variant": "#e3e1eb",
                        "tertiary-fixed": "#6df8ec",
                        "primary-fixed-dim": "#bac3ff",
                        "on-error-container": "#93000a",
                        "on-tertiary": "#ffffff",
                        "inverse-surface": "#2f3037",
                        "on-secondary-fixed": "#3f0400",
                        "on-primary-fixed": "#001159",
                        "on-secondary": "#ffffff",
                        "primary-container": "#002395",
                        "primary-fixed": "#dee1ff",
                        "on-secondary-container": "#fffbff",
                        "on-error": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Manrope"],
                        "display": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Public Sans"]
                    }
                },
            }
        }
    </script>
</head>
<body class="bg-surface text-on-surface">
<!-- Sidebar Navigation -->
<aside class="h-screen w-64 fixed left-0 top-0 bg-slate-100 dark:bg-slate-900 flex flex-col h-full py-8 z-50">
<div class="px-6 mb-10">
<h1 class="font-[Manrope] font-black text-[#001360] dark:text-blue-200 text-xl tracking-tight">Curador Académico</h1>
<p class="text-xs font-label uppercase tracking-widest text-outline mt-1">Portal Institucional</p>
</div>
<nav class="flex-1 space-y-1">
<a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('superadministrador.dashboard') }}">
<span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="home">home</span>
                Inicio
            </a>
<a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('superadministrador.ranking.index') }}">
<span class="material-symbols-outlined mr-3" data-icon="leaderboard" style="font-variation-settings: 'FILL' 1;">leaderboard</span>
                Ranking
            </a>
<a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('superadministrador.pesos.index') }}">
<span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="functions">functions</span>
                Fórmulas
            </a>
<a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('superadministrador.reportes.index') }}">
<span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="analytics">analytics</span>
                Reportes
            </a>
<a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('superadministrador.usuarios.index') }}">
<span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="group">group</span>
                Usuarios
            </a>
<a class="flex items-center border-l-4 border-[#001360] bg-slate-200/50 dark:bg-slate-800/50 text-[#001360] dark:text-blue-300 font-bold px-6 py-4 transition-all duration-200" href="{{ route('superadministrador.semestres.index') }}">
<span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="functions">calendar_month</span>
                semestres
            </a>
<a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('superadministrador.upload.index') }}">
<span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="group">file_upload</span>
                subir
</a>
</nav>
<div class="px-6 mt-auto">
<div class="mt-6 flex items-center gap-3 py-4 border-t border-outline-variant/20">
<div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold">
    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
</div>
<div>
<p class="text-sm font-bold text-on-surface">
    {{ explode('@', Auth::user()->name)[0] }}
</p>
<p class="text-xs text-outline">SuperAdmin</p>
</div>
</div>
</aside>
<!-- Main Canvas -->
<main class="ml-64 min-h-screen">
<!-- Top App Bar -->
<header class="w-full sticky top-0 z-40 bg-[#fbf8ff] dark:bg-slate-950 shadow-sm dark:shadow-none flex justify-between items-center px-5 py-3">
<div class="flex items-center gap-2">
    <img src="{{ asset('images/cedhi.png') }}" alt="CEDHI" class="w-32 h-32 rounded-lg">
    <h2 class="font-[Manrope] font-extrabold text-[#001360] dark:text-blue-100 text-2xl tracking-tight">Semestres</h2>
</div>
<div class="flex items-center gap-6">
<div class="flex items-center gap-4 border-l border-outline-variant/30 pl-6">
</div>
<div class="lg:block border-t border-gray-100 pt-0">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-rose-500 transition-colors hover:bg-rose-50 hover:text-rose-700">
            <span>⎋</span>
            Cerrar sesión
        </button>
    </form>
</div>
</div>
</header>
<!-- Main Canvas -->
<main class="ml-64 pt-24 pb-12 px-10 min-h-screen">
<!-- Header Section -->
<section class="mb-10">
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h2 class="text-display-sm font-headline font-extrabold text-primary tracking-tight text-4xl mb-2">Gestión de Semestres</h2>
<p class="text-on-surface-variant font-body opacity-80 max-w-2xl">Configure los periodos lectivos institucionales. Defina el año académico y el ciclo correspondiente para la carga de notas y rankings.</p>
</section>
<!-- Bento Layout -->
<div class="grid grid-cols-12 gap-8">
<!-- Form Column -->
<div class="col-span-12 lg:col-span-7">
<div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-outline-variant/10 relative overflow-hidden group">
<!-- Subtle background decoration -->
<div class="absolute -top-24 -right-24 w-48 h-48 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-all duration-700"></div>
<h3 class="text-xl font-headline font-bold text-on-surface mb-8 flex items-center gap-3">
<span class="material-symbols-outlined text-primary">calendar_add_on</span>
                        Crear Nuevo Perfil de Semestre
                    </h3>
<form class="space-y-8"
      id="semesterForm"
      method="POST"
      action="{{ route('superadministrador.semestres.store') }}">
    @csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<!-- Year Input -->
<div class="space-y-2">
<label class="block text-sm font-label font-semibold text-on-surface-variant">Año Académico</label>
<div class="flex items-center bg-surface-container-highest rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-primary/20 transition-all">
<span class="px-4 py-3 bg-surface-container-high text-on-surface-variant font-bold border-r border-outline-variant/20">20</span>
<input class="w-full bg-transparent border-none py-3 px-4 focus:ring-0 font-bold text-primary placeholder:opacity-30"
       id="yearInput"
       name="year"
       maxlength="2"
       placeholder="25"
       type="text"
       value="25"></div>
<p class="text-[11px] text-outline font-label">Ingrese los últimos dos dígitos del año.</p>
</div>
<!-- Period Selector -->
<div class="space-y-2">
<label class="block text-sm font-label font-semibold text-on-surface-variant">Periodo / Ciclo</label>
<div class="flex p-1 bg-surface-container-highest rounded-lg">
<button class="flex-1 py-2 text-sm font-bold rounded-md transition-all bg-surface-container-lowest text-primary shadow-sm" id="btn-period-1" onclick="setPeriod('1')" type="button">1</button>
<button class="flex-1 py-2 text-sm font-bold rounded-md transition-all text-on-surface-variant hover:text-primary" id="btn-period-2" onclick="setPeriod('2')" type="button">2</button>
</div>
<input id="periodInput"
       name="period"
       type="hidden"
       value="1">   </div>
</div>
<!-- Result Preview -->
<div class="p-6 bg-surface-container-low rounded-xl border-l-4 border-primary/20">
<div class="flex items-center justify-between">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-primary opacity-60">info</span>
<div>
<p class="text-xs font-label uppercase tracking-widest text-on-surface-variant opacity-70">Vista Previa</p>
<p class="text-lg font-headline font-bold text-primary" id="previewText">Formato resultante: 2025-1</p>
</div>
</div>
<div class="w-12 h-12 rounded-full border-2 border-dashed border-outline-variant/30 flex items-center justify-center">
<span class="material-symbols-outlined text-outline-variant">check_circle</span>
</div>
</div>
</div>
<!-- Submit CTA -->
<div class="pt-4">
    <button class="w-full bg-[#001360] text-white py-4 px-8 rounded-lg font-headline font-bold flex items-center justify-center gap-3 hover:opacity-90 active:scale-[0.98] transition-all shadow-lg shadow-primary/10" type="submit">
    <span class="">Crear Semestre</span>
    </button>
</div>
</form>
</div>
</div>
<!-- History Column -->
<div class="col-span-12 lg:col-span-5 space-y-6">
<div class="bg-surface-container-low rounded-xl p-6 h-full flex flex-col">
<div class="flex items-center justify-between mb-6">
<h3 class="text-lg font-headline font-bold text-on-surface">Últimos 5 Semestres Creados</h3>
<span class="material-symbols-outlined text-outline cursor-pointer hover:text-primary transition-colors">history</span>
</div>
<div class="flex-1 space-y-3">
@forelse($semestres as $semestre)

<div class="flex items-center justify-between p-4 bg-surface-container-lowest rounded-lg group hover:scale-[1.01] transition-transform duration-200 cursor-default">

    <div class="flex items-center gap-4">

        <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary">
            <span class="material-symbols-outlined">
                event_available
            </span>
        </div>

        <div>
            <p class="font-headline font-bold text-on-surface">
                {{ $semestre->nombre }}
            </p>

            <p class="text-xs text-outline font-label">
                Creado el {{ $semestre->created_at->format('d M, Y') }}
            </p>
        </div>

    </div>

    <form method="POST"
      action="{{ route('superadministrador.semestres.destroy', $semestre->id) }}"
      onsubmit="return confirm('¿Seguro que deseas eliminar el semestre {{ $semestre->nombre }}? También se eliminarán todas las notas relacionadas.');">
    @csrf
    @method('DELETE')

    <button type="submit"
            class="w-9 h-9 flex items-center justify-center rounded-full text-red-600 hover:bg-red-100 hover:text-red-800 transition-all"
            title="Eliminar semestre">
        <span class="material-symbols-outlined text-[22px]">
            close
        </span>
    </button>
</form>

</div>

@empty

<div class="p-4 text-center text-outline">
    No hay semestres creados.
</div>

@endforelse
</div>

</div>
</div>
</div>
<!-- Informational Footer -->
<div class="mt-12 flex flex-wrap gap-8 items-start opacity-70">
<div class="flex items-center gap-3 max-w-xs">
<span class="material-symbols-outlined text-secondary text-lg">verified_user</span>
<p class="text-[11px] font-label">Los semestres creados son auditados por el sistema de Gestión de Calidad Académica.</p>
</div>
<div class="flex items-center gap-3 max-w-xs">
<span class="material-symbols-outlined text-tertiary text-lg">info_i</span>
<p class="text-[11px] font-label">Al crear un nuevo semestre, se habilitarán automáticamente los formularios de matrícula.</p>
</div>
</div>
</main>
<script>
    const yearInput = document.getElementById('yearInput');
    const periodInput = document.getElementById('periodInput');
    const previewText = document.getElementById('previewText');
    const btn1 = document.getElementById('btn-period-1');
    const btn2 = document.getElementById('btn-period-2');

    function updatePreview() {
        const yearVal = yearInput.value || 'XX';
        const periodVal = periodInput.value;
        previewText.innerText = `Formato resultante: 20${yearVal}-${periodVal}`;
    }

    function setPeriod(p) {
        periodInput.value = p;

        if(p === '1') {
            btn1.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
            btn1.classList.remove('text-on-surface-variant');

            btn2.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
            btn2.classList.add('text-on-surface-variant');
        } else {
            btn2.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
            btn2.classList.remove('text-on-surface-variant');

            btn1.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
            btn1.classList.add('text-on-surface-variant');
        }

        updatePreview();
    }

    yearInput.addEventListener('input', (e) => {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
        updatePreview();
    });

    updatePreview();
</script>

</body>
</html>
