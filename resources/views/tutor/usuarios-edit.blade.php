<!DOCTYPE html> 
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Editar Usuario | Curador Académico</title>
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
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-on-surface">

    <aside class="h-screen w-64 fixed left-0 top-0 bg-slate-100 dark:bg-slate-900 flex flex-col h-full py-8 z-50">
        <div class="px-6 mb-10">
            <h1 class="font-[Manrope] font-black text-[#001360] dark:text-blue-200 text-xl tracking-tight">Curador Académico</h1>
            <p class="text-xs font-label uppercase tracking-widest text-outline mt-1">Portal Institucional</p>
        </div>
        <nav class="flex-1 space-y-1">
            <a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('tutor.dashboard') }}">
            <span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="home">home</span>
                            Inicio
                        </a>
            <a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('tutor.ranking.index') }}">
            <span class="material-symbols-outlined mr-3" data-icon="leaderboard" style="font-variation-settings: 'FILL' 1;">leaderboard</span>
                            Ranking
                        </a>
            <a class="flex items-center border-l-4 border-[#001360] bg-slate-200/50 dark:bg-slate-800/50 text-[#001360] dark:text-blue-300 font-bold px-6 py-4 transition-all duration-200" href="{{ route('tutor.usuarios.index') }}">
            <span class="material-symbols-outlined mr-3 group-hover:scale-110 transition-transform" data-icon="group">group</span>
                            Usuarios
                        </a>
            <a class="flex items-center text-slate-500 dark:text-slate-400 font-medium px-6 py-4 hover:bg-slate-200 dark:hover:bg-slate-800 transition-all duration-200 group" href="{{ route('tutor.upload.index') }}">
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
                    <p class="text-xs text-outline">Tutor</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="ml-64 min-h-screen">
        <header class="w-full sticky top-0 z-40 bg-[#fbf8ff] dark:bg-slate-950 shadow-sm dark:shadow-none flex justify-between items-center px-5 py-3">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/cedhi.png') }}" alt="CEDHI" class="w-32 h-32 rounded-lg">
                <h2 class="font-[Manrope] font-extrabold text-[#001360] dark:text-blue-100 text-2xl tracking-tight">Creación de perfiles</h2>
            </div>
            
            <div>
                <form method="POST" action="{{ route('tutor.usuarios.destroy', $user->id) }}" onsubmit="return confirm('¿Está completamente seguro de eliminar este usuario?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm font-bold text-error hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">delete</span> Eliminar Usuario
                    </button>
                </form>
            </div>
        </header>

        <div class="px-12 py-8 bg-surface-container-low min-h-[calc(100vh-100px)] flex justify-center items-start">
            
            <div class="w-full max-w-xl bg-surface-container-lowest rounded-3xl p-8 shadow-sm ring-1 ring-outline-variant/15">
                <h3 class="text-xl font-extrabold text-primary mb-2">Editar Perfil de Usuario</h3>
                <p class="text-xs text-outline mb-6">Modifique las credenciales y la jerarquía del perfil seleccionado.</p>

                <form method="POST" action="{{ route('tutor.usuarios.update', $user->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-outline mb-2 ml-1">Nombre Completo</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-none bg-surface-container-low rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-outline mb-2 ml-1">Email Institucional</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-none bg-surface-container-low rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-outline mb-2 ml-1">DNI / Documento</label>
                        <input type="text" name="dni" value="{{ old('dni', $user->dni) }}" class="w-full border-none bg-surface-container-low rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-outline mb-2 ml-1">Rol Asignado</label>
                        <select name="rol_id" class="w-full border-none bg-surface-container-low rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary" required>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}" @selected(old('rol_id', $user->rol_id) == $rol->id)>
                                    {{ $rol->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-outline-variant/10 mt-6">
                        <a href="{{ route('tutor.usuarios.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-outline hover:bg-surface-container-high transition-colors">Cancelar</a>
                        <button type="submit" class="px-6 py-2.5 bg-[#001360] text-white rounded-xl font-semibold shadow-sm hover:bg-opacity-90 transition-colors">Actualizar Perfil</button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</body>
</html>
