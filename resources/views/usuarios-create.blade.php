<form method="POST" action="{{ route('usuarios.store') }}">

    @csrf

    <div class="mb-4">

        {{-- ----------------------------------------------------------------------------------- --}}
        {{-- OJO: ESTA ES LA PANTALLA PARA CREAR UN USUARIO, USADO EN SUPERADMINISTRADOR ----------}}
        {{-- ----------------------------------------------------------------------------------- --}}


        <label class="block mb-2 font-semibold">
            Nombre
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Nombre completo"
            class="w-full border rounded-lg p-3"
            required>

    </div>

    <div class="mb-4">

        <label class="block mb-2 font-semibold">
            Email
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="correo@ejemplo.com"
            class="w-full border rounded-lg p-3"
            required>

    </div>

    <div class="mb-4">

        <label class="block mb-2 font-semibold">
            DNI
        </label>

        <input
            type="text"
            name="dni"
            value="{{ old('dni') }}"
            placeholder="Ingrese DNI"
            class="w-full border rounded-lg p-3"
            required>

    </div>

    <div class="mb-6">

        <label class="block mb-2 font-semibold">
            Rol
        </label>

        <select
            name="rol_id"
            class="w-full border rounded-lg p-3"
            required>

            @foreach($roles as $rol)

                <option value="{{ $rol->id }}">
                    {{ $rol->nombre }}
                </option>

            @endforeach

        </select>

    </div>

    <button
        type="submit"
        class="bg-blue-600 text-white px-5 py-3 rounded-lg">

        Guardar

    </button>

</form>