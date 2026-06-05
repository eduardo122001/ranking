<form
    method="POST"
    action="{{ route('usuarios.update', $user->id) }}">

    @csrf
    @method('PUT')

    <div class="mb-4">
        {{-- ----------------------------------------------------------------------------------- --}}
        {{-- OJO: ESTA ES LA PANTALLA PARA EDITAR UN USUARIO, USADO EN SUPERADMINISTRADOR ---------}}
        {{-- ----------------------------------------------------------------------------------- --}}

        <label class="block mb-2 font-semibold">
            Nombre
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}"
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
            value="{{ old('email', $user->email) }}"
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
            value="{{ old('dni', $user->dni) }}"
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

                <option
                    value="{{ $rol->id }}"
                    @selected(old('rol_id', $user->rol_id) == $rol->id)>

                    {{ $rol->nombre }}

                </option>

            @endforeach

        </select>

    </div>

    <button
        type="submit"
        class="bg-blue-600 text-white px-5 py-3 rounded-lg">

        Actualizar

    </button>

</form>