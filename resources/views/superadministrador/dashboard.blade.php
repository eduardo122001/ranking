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
<a class="flex items-center border-l-4 border-[#001360] bg-slate-200/50 dark:bg-slate-800/50 text-[#001360] dark:text-blue-300 font-bold px-6 py-4 transition-all duration-200" href="{{ route('superadministrador.dashboard') }}">
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
<a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('superadministrador.semestres.index') }}">
<span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="functions">calendar_month</span>
                semestres
            </a>
</nav>
<div class="px-6 mt-auto">
<div class="mt-6 flex items-center gap-3 py-4 border-t border-outline-variant/20">
<img alt="Administrador" class="w-10 h-10 rounded-full object-cover" data-alt="portrait of a professional male administrator in a suit, soft office lighting, clean professional background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-JTyjZBk3omPlPuaOppGzykkMO4WfUljN6x9ZabsJEfokoiMTUFIzVQdTAPWxsrjVd5LQDex0WjxUtTi--05x-AjZkQwzFxKz6Nck5Rfa06KU0hTCbYnNhF-RDWeIqxXWXMdf-nvY98f-2QNJ4U3xlB0RuA6_NLkrsV1x79D8whezx3BL4kXpT_Lv0kQ30epc3ECl6R9Tr6rItZLQ9qZ-QQ38Kj_GDcYRUqIu0mt_yqqJfrgo58T_xZU0yUVcYIpS7AJkKxGNxA"/>
<div>
<p class="text-sm font-bold text-on-surface">Admin Global</p>
<p class="text-xs text-outline">Sede Central</p>
</div>
</div>
</div>
</aside>
<!-- Main Canvas -->
<main class="ml-64 min-h-screen">
<!-- Top App Bar -->
<header class="w-full sticky top-0 z-40 bg-[#fbf8ff] dark:bg-slate-950 shadow-sm dark:shadow-none flex justify-between items-center px-12 py-6">
<div class="flex flex-col">
<h2 class="font-[Manrope] font-extrabold text-[#001360] dark:text-blue-100 text-2xl tracking-tight">Usuarios</h2>
<p class="text-sm font-label text-outline">Consolidado Académico 2024-II</p>
</div>
<div class="flex items-center gap-6">
<!-- Search Bar -->
<div class="relative focus-within:ring-2 focus-within:ring-[#001360]/20 rounded-full transition-all">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline" data-icon="search">search</span>
<input class="pl-12 pr-6 py-2.5 bg-surface-container-highest border-none rounded-full w-80 text-sm focus:ring-0 placeholder:text-outline/60" placeholder="Buscar estudiante..." type="text"/>
</div>
<div class="flex items-center gap-4 border-l border-outline-variant/30 pl-6">
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<button class="p-2 text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined" data-icon="account_circle">account_circle</span>
</button>
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
</div>
</header>
<!-- Content Area -->

<div class="px-12 py-8 bg-surface-container-low min-h-[calc(100vh-100px)]">

    BIENVENIDO Superadministrador

</div>

<!-- Dashboard Insight Card -->
</div>
</main>
</body></html>