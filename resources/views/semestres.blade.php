<!DOCTYPE html><html class="light" lang="es"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Gestión de Semestres - The Academic Curator</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=Public+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-surface": "#1a1b22",
                    "tertiary": "#002421",
                    "primary-fixed": "#dee1ff",
                    "on-secondary": "#ffffff",
                    "on-primary-container": "#8094ff",
                    "on-primary-fixed": "#001159",
                    "background": "#fbf8ff",
                    "on-secondary-fixed": "#3f0400",
                    "inverse-surface": "#2f3037",
                    "outline-variant": "#c5c5d5",
                    "surface-container-high": "#e9e7f1",
                    "surface-container": "#eeedf6",
                    "on-surface-variant": "#444653",
                    "secondary-container": "#e22707",
                    "primary-container": "#002395",
                    "surface-container-highest": "#e3e1eb",
                    "surface-variant": "#e3e1eb",
                    "surface-container-low": "#f4f2fc",
                    "primary": "#001360",
                    "on-primary-fixed-variant": "#223aa8",
                    "error-container": "#ffdad6",
                    "surface-container-lowest": "#ffffff",
                    "inverse-primary": "#bac3ff",
                    "primary-fixed-dim": "#bac3ff",
                    "secondary-fixed-dim": "#ffb4a5",
                    "surface-tint": "#3e54c1",
                    "outline": "#757684",
                    "on-tertiary-container": "#00afa5",
                    "surface-bright": "#fbf8ff",
                    "on-error": "#ffffff",
                    "secondary-fixed": "#ffdad3",
                    "tertiary-fixed-dim": "#4adbcf",
                    "on-tertiary-fixed": "#00201e",
                    "error": "#ba1a1a",
                    "inverse-on-surface": "#f1eff9",
                    "on-error-container": "#93000a",
                    "tertiary-fixed": "#6df8ec",
                    "on-tertiary": "#ffffff",
                    "tertiary-container": "#003b37",
                    "secondary": "#b61900",
                    "on-tertiary-fixed-variant": "#00504b",
                    "on-secondary-fixed-variant": "#8f1100",
                    "surface-dim": "#dad9e3",
                    "surface": "#fbf8ff",
                    "on-secondary-container": "#fffbff",
                    "on-primary": "#ffffff",
                    "on-background": "#1a1b22"
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
          }
        }
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-header {
            backdrop-filter: blur(20px);
            background-color: rgba(255, 255, 255, 0.85);
        }
        .primary-gradient {
            background: linear-gradient(135deg, #001360 0%, #002395 100%);
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fbf8ff;
        }
        .font-headline { font-family: 'Manrope', sans-serif; }
        .font-display { font-family: 'Manrope', sans-serif; }
        .font-label { font-family: 'Public Sans', sans-serif; }
    </style>
</head>
<body class="text-on-surface">
<!-- SideNavBar Shell -->
<aside class="h-screen w-64 fixed left-0 top-0 bg-surface-container-low dark:bg-surface-dim flex flex-col py-6 z-50">
<div class="px-6 mb-10">
<h1 class="font-display font-bold text-primary dark:text-primary-fixed text-2xl tracking-tight">The Curator</h1>
<p class="font-label text-[10px] uppercase tracking-widest text-on-surface-variant mt-1 opacity-70">Academic Management</p>
</div>
<nav class="flex-1 space-y-1">
<!-- Navigation Items Mapping -->
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high transition-colors duration-200" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-headline text-title-sm tracking-wide">Inicio</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high transition-colors duration-200" href="#">
<span class="material-symbols-outlined">leaderboard</span>
<span class="font-headline text-title-sm tracking-wide">Ranking</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high transition-colors duration-200" href="#">
<span class="material-symbols-outlined">functions</span>
<span class="font-headline text-title-sm tracking-wide">Fórmulas</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high transition-colors duration-200" href="#">
<span class="material-symbols-outlined">description</span>
<span class="font-headline text-title-sm tracking-wide">Reportes</span>
</a>
<!-- Active Navigation Logic: "Gesti\u00f3n de Usuarios" is related to Administration/Semesters -->
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-high transition-colors duration-200" href="#">
<span class="material-symbols-outlined">calendar_month</span>
<span class="font-headline text-title-sm tracking-wide">Gestión de Semestres</span>
</a><a class="flex items-center gap-3 px-4 py-3 text-primary font-bold border-l-4 border-primary bg-surface-container-high" href="#">
<span class="material-symbols-outlined">group</span>
<span class="font-headline text-title-sm tracking-wide">Gestión de Usuarios</span>
</a>
</nav>
<div class="px-6 mt-auto pt-6 border-t border-outline-variant/10">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold overflow-hidden">
<img alt="Academic Administrator Profile" data-alt="A professional studio portrait of a senior academic administrator with a warm smile, wearing business attire, set against a blurred background of a modern university library with mahogany shelves and soft ambient lighting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVxr-_Ipoo_28TUB8GDxI9NC5ws6YuYruPvesbCUyQqWfn5jNb-OIxOImKLZH_V_yc1Bsyy60C1fxAKmXn1LRCxnyrpYZ1N3ijnKVlq0uYf3NTTibtKmyg60z7uIcOq4fucB0XPhR1hFvlUa0PizTT00u9Vp31ZwvkJ4snf6BrrMssf1I0yLm-EqJfpR5BWndsNDmCB3BFmLEtM7Xin24pNCXua1vLH_z7U1hBWCdZARqQgaTOUsqj6UrrBG_HM-qU-WJJnIGNhg">
</div>
<div>
<p class="text-sm font-bold text-on-surface">Admin</p>
<p class="text-[10px] text-on-surface-variant">Central Office</p>
</div>
</div>
</div>
</aside>
<!-- TopNavBar Shell -->
<header class="fixed top-0 right-0 w-[calc(100%-16rem)] z-40 h-16 glass-header flex justify-between items-center px-8">
<div class="flex items-center gap-4">
<div class="relative group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
<input class="pl-10 pr-4 py-2 bg-surface-container-highest/50 border-none rounded-full text-sm focus:ring-2 focus:ring-primary/20 w-64 transition-all" placeholder="Buscar registros..." type="text">
</div>
</div>
<div class="flex items-center gap-4">
<button class="p-2 hover:bg-surface-container-high rounded-full transition-all text-on-surface-variant">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 hover:bg-surface-container-high rounded-full transition-all text-on-surface-variant">
<span class="material-symbols-outlined">settings</span>
</button>
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
      action="{{ route('semestres.store') }}">
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
<button class="w-full primary-gradient text-white py-4 px-8 rounded-lg font-headline font-bold flex items-center justify-center gap-3 hover:opacity-90 active:scale-[0.98] transition-all shadow-lg shadow-primary/10" type="submit">
<span class="">Crear Semestre</span>
<span class="material-symbols-outlined">rocket_launch</span>
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