<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Documentación Académica</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f6f7fb] text-slate-900 antialiased">

    <div class="min-h-screen flex">

        <aside class="hidden lg:flex w-72 flex-col border-r border-slate-200 bg-white/80 backdrop-blur">
            <div class="px-6 py-5 border-b border-slate-200">
                <div class="text-2xl font-black tracking-tight text-[#0f1f63]">Inicio</div>
            </div>

            <div class="px-6 py-6">
                <div class="text-sm font-semibold text-slate-500 uppercase tracking-[0.18em]">Gestión Académica</div>
                <p class="text-sm text-slate-400 mt-1">Portal del Tutor</p>

                <nav class="mt-8 space-y-2">
                    <a href="#" class="flex items-center gap-3 rounded-xl bg-[#eef2ff] px-4 py-3 text-sm font-semibold text-[#0f1f63]">
                        <span>⌂</span>
                        Inicio
                    </a>
                </nav>
            </div>

            <div class="mt-auto p-6">
                <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4 flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-[#0f1f63] text-white flex items-center justify-center font-bold">
                        JD
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-slate-800">Juan Delgado</div>
                        <div class="text-xs text-slate-500">Tutor Principal</div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1">

            <header class="h-16 border-b border-slate-200 bg-white/70 backdrop-blur">
                <div class="h-full px-5 lg:px-8 flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-[#0f1f63]">Inicio</div>
                    </div>

                    <div class="flex items-center gap-5 text-sm text-slate-500">
                        <span class="text-slate-300">🔔</span>
                        <span class="text-slate-300">⚙</span>
                    </div>
                </div>
            </header>

            <div class="px-4 py-6 sm:px-6 lg:px-8">

                <div class="max-w-6xl mx-auto">

                    <section class="mb-8">
                        <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#0f1f63]">
                            Carga de Documentación Académica
                        </h1>
                        <p class="mt-2 max-w-3xl text-sm sm:text-base text-slate-500">
                            Actualice los registros académicos del semestre en curso mediante la carga de archivos estructurados.
                        </p>
                    </section>

                    <section class="rounded-[28px] bg-white border border-slate-200 shadow-sm p-6 sm:p-8">
                        <div class="max-w-3xl mx-auto">
                            <form action="/upload" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if(session('success'))
                                    <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                                        {{ $errors->first() }}
                                    </div>
                                @endif

                                <div class="rounded-[28px] border-2 border-dashed border-[#d8def6] bg-[#fbfcff] p-6 sm:p-10 text-center">
                                    
                                    <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#eef2ff] text-[#0f1f63]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                        </svg>
                                    </div>

                                    <h2 class="text-xl sm:text-2xl font-bold text-[#0f1f63]">
                                        Subir Archivo de Notas
                                    </h2>

                                    <p class="mt-2 text-sm sm:text-base text-slate-500">
                                        Seleccione un archivo desde su computadora para iniciar la carga masiva.
                                    </p>

                                    <p class="mt-3 text-[11px] sm:text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">
                                        Formatos compatibles: Excel, XLSX, CSV
                                    </p>

                                    <div class="mt-7 text-left max-w-md mx-auto">
                                        <label class="block mb-2 text-sm font-semibold text-slate-700">
                                            Seleccionar semestre
                                        </label>

                                        <select
                                            name="semestre_id"
                                            required
                                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none focus:border-[#0f1f63] focus:ring-2 focus:ring-[#0f1f63]/20"
                                        >
                                            <option value="">Seleccione un semestre</option>

                                            @foreach($semestres as $semestre)
                                                <option value="{{ $semestre->id }}">
                                                    {{ $semestre->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                                        
                                        <label for="file" id="labelArchivo" class="w-full sm:w-auto cursor-pointer rounded-2xl border-2 border-[#0f1f63] bg-white px-6 py-3 text-sm font-semibold text-[#0f1f63] transition hover:bg-[#f8faff] text-center truncate max-w-[250px]">
                                            Elegir Archivo...
                                        </label>

                                        <input
                                            id="file"
                                            type="file"
                                            name="file"
                                            required
                                            class="hidden"
                                            onchange="mostrarArchivo(this)"
                                        >

                                        <button
                                            type="submit"
                                            class="w-full sm:w-auto rounded-2xl bg-[#0f1f63] px-6 py-3 text-sm font-semibold text-white shadow-md shadow-[#0f1f63]/20 transition hover:bg-[#142a86]">
                                            Procesar Carga
                                        </button>

                                    </div>
                                    
                                    <div class="mt-6">
                                        <a href="#" class="text-sm font-semibold text-slate-400 hover:text-[#0f1f63] transition underline decoration-transparent hover:decoration-[#0f1f63]">
                                            Descargar Plantilla Base
                                        </a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </section>

                </div>
            </div>
        </main>
    </div>

    <script>
        function mostrarArchivo(input) {
            const label = document.getElementById('labelArchivo');
            if (input.files && input.files[0]) {
                const nombreCorto = input.files[0].name.length > 20 
                    ? input.files[0].name.substring(0, 17) + '...' 
                    : input.files[0].name;
                
                label.textContent = '📁 ' + nombreCorto;
                label.classList.add('bg-[#eef2ff]', 'border-transparent');
                label.classList.remove('bg-white', 'border-[#0f1f63]');
            } else {
                label.textContent = 'Elegir Archivo...';
                label.classList.remove('bg-[#eef2ff]', 'border-transparent');
                label.classList.add('bg-white', 'border-[#0f1f63]');
            }
        }
    </script>
</body>
</html>