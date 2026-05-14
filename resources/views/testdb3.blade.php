<!DOCTYPE html>
<html>
<head>
    <title>Test DB ranking_estudiantes2</title>
</head>
<body>

    <h1>Probando conexión DB...</h1>

    @php
        try {
            DB::connection()->getPdo();
            echo "Conexion exitosa a MySQL";
            
        } catch (\Exception $e) {
            echo "Error de conexion ";
            echo "<br><br>";
            echo $e->getMessage();
        }
    @endphp

<p>
    Base actual:
    {{ DB::connection()->getDatabaseName() }}
</p>
<h1>Actualizar Notas</h1>

<table border="1" cellpadding="10">

    <tr>

        <th>ID</th>
        <th>Estudiante</th>

        <th>Rendimiento</th>
        <th>Comportamiento</th>
        <th>Pagos</th>
        <th>Referente</th>

        <th>Actualizar</th>

    </tr>

    @foreach($rankings as $data)

    <tr>

        <form
            method="POST"
            action="/testdb3/update/{{ $data->id }}"
        >

            @csrf

            <td>{{ $data->id }}</td>

            <td>{{ $data->estudiante }}</td>

            <td>
                <input
                    type="number"
                    step="0.01"
                    name="rendimiento"
                    value="{{ $data->rendimiento }}"
                >
            </td>

            <td>
                <input
                    type="number"
                    step="0.01"
                    name="comportamiento"
                    value="{{ $data->comportamiento }}"
                >
            </td>

            <td>
                <input
                    type="number"
                    step="0.01"
                    name="pagos"
                    value="{{ $data->pagos }}"
                >
            </td>

            <td>
                <input
                    type="number"
                    step="0.01"
                    name="referente"
                    value="{{ $data->referente }}"
                >
            </td>

            <td>

                <button type="submit">
                    Actualizar
                </button>

            </td>

        </form>

    </tr>

    @endforeach

</table>

</body>
</html>