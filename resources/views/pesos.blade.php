<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Pesos</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-headline {
            font-family: 'Manrope', sans-serif;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>


<body class="bg-[#f6f7fb] text-slate-900 antialiased">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="hidden lg:flex w-72 flex-col border-r border-slate-200 bg-white/80 backdrop-blur">

        <div class="px-6 py-5 border-b border-slate-200">
            <div class="text-2xl font-black tracking-tight text-[#0f1f63]">
                Gestión Académica
            </div>
        </div>

        <div class="px-6 py-6">

            <div class="text-sm font-semibold text-slate-500 uppercase tracking-[0.18em]">
                Panel Administrativo
            </div>

            <nav class="mt-8 space-y-2">

                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-100">
                    Inicio
                </a>

                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-100">
                    Ranking
                </a>

                <a href="#"
                   class="flex items-center gap-3 rounded-xl bg-[#eef2ff] px-4 py-3 text-sm font-semibold text-[#0f1f63]">
                    Fórmulas
                </a>

                <a href="#"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-500 hover:bg-slate-100">
                    Reportes
                </a>

            </nav>
        </div>

        <div class="mt-auto p-6">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                    Cerrar sesión
                </button>
            </form>

        </div>
    </aside>

    <!-- Main -->
    <main class="flex-1">

        <!-- Header -->
        <header class="h-16 border-b border-slate-200 bg-white/70 backdrop-blur">

            <div class="h-full px-5 lg:px-8 flex items-center justify-between">

                <div>
                    <div class="text-sm font-semibold text-[#0f1f63]">
                        Configuración de Fórmulas
                    </div>
                </div>

                <div class="flex items-center gap-5 text-sm text-slate-500">
                    ⚙
                </div>

            </div>

        </header>

        <!-- Content -->
        <div class="px-4 py-6 sm:px-6 lg:px-8">

            <div class="max-w-5xl mx-auto">

                <!-- Hero -->
                <section class="mb-8">

                    <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-[#0f1f63] font-headline">
                        Fórmula de Ranking
                    </h1>

                    <p class="mt-2 max-w-3xl text-sm sm:text-base text-slate-500">
                        Define los pesos porcentuales para el cálculo automático del ranking institucional.
                    </p>

                </section>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Form Card -->
                <section class="rounded-[28px] bg-white border border-slate-200 shadow-sm p-6 sm:p-8">

                    <form action="{{ route('pesos.update') }}" method="POST">

                        @csrf

                        <div class="flex items-center justify-between mb-10">

                            <div>
                                <h2 class="text-2xl font-bold text-[#0f1f63] font-headline">
                                    Métricas Clave
                                </h2>

                                <p class="text-sm text-slate-500 mt-1">
                                    Los porcentajes deben sumar exactamente 100%.
                                </p>
                            </div>

                            <div class="rounded-2xl bg-[#eef2ff] px-5 py-3">

                                <div class="text-xs font-bold uppercase tracking-[0.18em] text-[#0f1f63]">
                                    Total
                                </div>

                                <div
    id="totalPorcentaje"
    class="text-2xl font-black text-[#0f1f63]">
    {{ $total }}%
</div>

                            </div>

                        </div>

                        <div class="space-y-6">

                            <!-- Rendimiento -->
                            <div class="flex flex-col md:flex-row md:items-center gap-5 rounded-2xl border border-slate-200 p-5">

                                <div class="flex-1">

                                    <h3 class="text-lg font-bold text-[#0f1f63]">
                                        Rendimiento Académico
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Promedio ponderado de calificaciones.
                                    </p>

                                </div>

                                <div class="relative w-full md:w-28">

                                    <input
                                        type="number"
                                        name="rendimiento"
                                        min="0"
                                        max="100"
                                        value="{{ old('rendimiento', $peso->rendimiento) }}"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-right text-2xl font-black text-[#0f1f63] outline-none focus:border-[#0f1f63] focus:ring-2 focus:ring-[#0f1f63]/20"
                                    >

                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">
                                        %
                                    </span>

                                </div>

                            </div>

                            <!-- Comportamiento -->
                            <div class="flex flex-col md:flex-row md:items-center gap-5 rounded-2xl border border-slate-200 p-5">

                                <div class="flex-1">

                                    <h3 class="text-lg font-bold text-[#0f1f63]">
                                        Comportamiento e Identidad
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Evaluación de conducta y participación.
                                    </p>

                                </div>

                                <div class="relative w-full md:w-28">

                                    <input
                                        type="number"
                                        name="comportamiento"
                                        min="0"
                                        max="100"
                                        value="{{ old('comportamiento', $peso->comportamiento) }}"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-right text-2xl font-black text-[#0f1f63] outline-none focus:border-[#0f1f63] focus:ring-2 focus:ring-[#0f1f63]/20"
                                    >

                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">
                                        %
                                    </span>

                                </div>

                            </div>

                            <!-- Pagos -->
                            <div class="flex flex-col md:flex-row md:items-center gap-5 rounded-2xl border border-slate-200 p-5">

                                <div class="flex-1">

                                    <h3 class="text-lg font-bold text-[#0f1f63]">
                                        Puntualidad de Pagos
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Cumplimiento financiero institucional.
                                    </p>

                                </div>

                                <div class="relative w-full md:w-28">

                                    <input
                                        type="number"
                                        name="pagos"
                                        min="0"
                                        max="100"
                                        value="{{ old('pagos', $peso->pagos) }}"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-right text-2xl font-black text-[#0f1f63] outline-none focus:border-[#0f1f63] focus:ring-2 focus:ring-[#0f1f63]/20"
                                    >

                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">
                                        %
                                    </span>

                                </div>

                            </div>

                            <!-- Referente -->
                            <div class="flex flex-col md:flex-row md:items-center gap-5 rounded-2xl border border-slate-200 p-5">

                                <div class="flex-1">

                                    <h3 class="text-lg font-bold text-[#0f1f63]">
                                        Alumnos Referentes
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Liderazgo positivo y referidos activos.
                                    </p>

                                </div>

                                <div class="relative w-full md:w-28">

                                    <input
                                        type="number"
                                        name="referente"
                                        min="0"
                                        max="100"
                                        value="{{ old('referente', $peso->referente) }}"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-right text-2xl font-black text-[#0f1f63] outline-none focus:border-[#0f1f63] focus:ring-2 focus:ring-[#0f1f63]/20"
                                    >

                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">
                                        %
                                    </span>

                                </div>

                            </div>

                        </div>

                        <!-- Button -->
                        <div class="mt-10 flex justify-end">

                            <button
                                type="submit"
                                class="rounded-2xl bg-[#0f1f63] px-8 py-4 text-sm font-semibold text-white shadow-lg shadow-[#0f1f63]/20 transition hover:bg-[#142a86]">

                                Guardar Cambios

                            </button>

                        </div>

                    </form>

                </section>

            </div>

        </div>

    </main>

</div>

<script>

    const inputs = document.querySelectorAll('input[type="number"]');

    const totalElemento = document.getElementById('totalPorcentaje');

    function actualizarTotal() {

        let total = 0;

        inputs.forEach(input => {

            total += parseFloat(input.value) || 0;

        });

        totalElemento.textContent = total + '%';

        // Cambiar color si no suma 100
        if (total === 100) {

            totalElemento.classList.remove('text-red-500');
            totalElemento.classList.add('text-[#0f1f63]');

        } else {

            totalElemento.classList.remove('text-[#0f1f63]');
            totalElemento.classList.add('text-red-500');

        }
    }

    // Escuchar cambios
    inputs.forEach(input => {

        input.addEventListener('input', actualizarTotal);

    });

    // Ejecutar al cargar
    actualizarTotal();

</script>


</body>


</html>