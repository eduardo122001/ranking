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

        <!-- Sidebar -->
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
                    <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-500 hover:bg-slate-50">
                        <span>▦</span>
                        Estudiantes
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-500 hover:bg-slate-50">
                        <span>✎</span>
                        Modificación Manual
                    </a>
                    <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-500 hover:bg-slate-50">
                        <span>▤</span>
                        Ranking
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

        <!-- Main -->
        <main class="flex-1">

            <!-- Topbar -->
            <header class="h-16 border-b border-slate-200 bg-white/70 backdrop-blur">
                <div class="h-full px-5 lg:px-8 flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-[#0f1f63]">Inicio</div>
                    </div>

                    <div class="flex items-center gap-5 text-sm text-slate-500">
                        <a href="#" class="hover:text-slate-800">Panel de Control</a>
                        <a href="#" class="hover:text-slate-800">Reportes</a>
                        <span class="text-slate-300">🔔</span>
                        <span class="text-slate-300">⚙</span>
                    </div>
                </div>
            </header>

            <div class="px-4 py-6 sm:px-6 lg:px-8">

                <div class="max-w-6xl mx-auto">

                    <!-- Title -->
                    <section class="mb-8">
                        <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#0f1f63]">
                            Carga de Documentación Académica
                        </h1>
                        <p class="mt-2 max-w-3xl text-sm sm:text-base text-slate-500">
                            Actualice los registros académicos del semestre en curso mediante la carga de archivos estructurados.
                        </p>
                    </section>

                    <!-- Upload Card -->
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
                                    <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#eef2ff] text-[#0f1f63] text-2xl">
                                        ⤴
                                    </div>

                                    <h2 class="text-xl sm:text-2xl font-bold text-[#0f1f63]">
                                        Carga de Documentación Académica
                                    </h2>

                                    <p class="mt-2 text-sm sm:text-base text-slate-500">
                                        Arrastre y suelte su archivo aquí o haga clic para seleccionar un archivo desde su computadora.
                                    </p>

                                    <p class="mt-3 text-[11px] sm:text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">
                                        Formatos compatibles: Excel, XLSX, CSV
                                    </p>

                                    <label for="file"
                                        class="mt-7 inline-flex cursor-pointer items-center justify-center rounded-2xl bg-[#0f1f63] px-5 py-3 text-sm font-semibold text-white shadow-md shadow-[#0f1f63]/20 transition hover:bg-[#142a86]">
                                        Subir CSV/Excel
                                    </label>

                                    <input
                                        id="file"
                                        type="file"
                                        name="file"
                                        required
                                        class="hidden"
                                        onchange="mostrarArchivo(this)"
                                    >

                                    <div id="archivoSeleccionado" class="mt-4 text-sm text-slate-500">
                                        Ningún archivo seleccionado
                                    </div>

                                    <div class="mt-7 flex flex-col sm:flex-row items-center justify-center gap-3">
                                        <button
                                            type="submit"
                                            class="w-full sm:w-auto rounded-2xl bg-[#0f1f63] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#142a86]">
                                            Subir CSV/Excel
                                        </button>

                                        <a href="#"
                                            class="w-full sm:w-auto rounded-2xl bg-[#eef2ff] px-6 py-3 text-sm font-semibold text-[#0f1f63] transition hover:bg-[#e2e8ff]">
                                            Descargar Plantilla
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>

                    <!-- History / Summary -->
                    <section class="mt-8 rounded-[28px] bg-white border border-slate-200 shadow-sm p-5 sm:p-6">
                        <div class="flex items-center justify-between gap-4 mb-5">
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-[#0f1f63]">Resumen de Datos Cargados</h3>
                                <p class="text-sm text-slate-500">Muestra preliminar de los últimos registros procesados.</p>
                            </div>
                            <a href="#" class="text-sm font-semibold text-[#0f1f63] hover:underline">
                                Ver Reporte Completo
                            </a>
                        </div>

                        <div class="overflow-x-auto rounded-2xl border border-slate-200">
                            <table class="min-w-full divide-y divide-slate-200 text-sm">
                                <thead class="bg-slate-50">
                                    <tr class="text-left text-[11px] uppercase tracking-[0.18em] text-slate-500">
                                        <th class="px-4 py-3 font-semibold">Estudiante</th>
                                        <th class="px-4 py-3 font-semibold">Sección</th>
                                        <th class="px-4 py-3 font-semibold">Calificación Media</th>
                                        <th class="px-4 py-3 font-semibold">Asistencia %</th>
                                        <th class="px-4 py-3 font-semibold">Estado de Pago</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 bg-white">
                                    <tr>
                                        <td class="px-4 py-3 font-medium text-slate-700">Álvarez, Ana</td>
                                        <td class="px-4 py-3 text-slate-600">A-1</td>
                                        <td class="px-4 py-3 text-slate-600">9.5</td>
                                        <td class="px-4 py-3">
                                            <div class="h-2 w-28 rounded-full bg-slate-200 overflow-hidden">
                                                <div class="h-full w-[92%] rounded-full bg-slate-900"></div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">AL DÍA</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-3 font-medium text-slate-700">Bermúdez, Carlos</td>
                                        <td class="px-4 py-3 text-slate-600">A-1</td>
                                        <td class="px-4 py-3 text-slate-600">8.2</td>
                                        <td class="px-4 py-3">
                                            <div class="h-2 w-28 rounded-full bg-slate-200 overflow-hidden">
                                                <div class="h-full w-[78%] rounded-full bg-slate-900"></div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">AL DÍA</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-3 font-medium text-slate-700">Díaz, Fernanda</td>
                                        <td class="px-4 py-3 text-slate-600">B-2</td>
                                        <td class="px-4 py-3 text-rose-600">5.4</td>
                                        <td class="px-4 py-3">
                                            <div class="h-2 w-28 rounded-full bg-slate-200 overflow-hidden">
                                                <div class="h-full w-[52%] rounded-full bg-rose-500"></div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-600">PENDIENTE</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-4 py-3 font-medium text-slate-700">Quispe, Luis</td>
                                        <td class="px-4 py-3 text-slate-600">A-1</td>
                                        <td class="px-4 py-3 text-slate-600">7.8</td>
                                        <td class="px-4 py-3">
                                            <div class="h-2 w-28 rounded-full bg-slate-200 overflow-hidden">
                                                <div class="h-full w-[85%] rounded-full bg-slate-900"></div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">AL DÍA</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-center text-xs uppercase tracking-[0.18em] text-slate-400">
                            Mostrando los últimos 4 registros de 124 estudiantes
                        </div>
                    </section>

                </div>
            </div>
        </main>
    </div>

    <script>
        function mostrarArchivo(input) {
            const nombre = input.files[0] ? input.files[0].name : 'Ningún archivo seleccionado';
            document.getElementById('archivoSeleccionado').textContent = nombre;
        }
    </script>
</body>
</html>