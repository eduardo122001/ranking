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

<h2>Filtros</h2>

<form method="GET" action="/testdb2">

    <label>Carrera</label>

    <select name="carrera">

        <option value="">
            Todas
        </option>

        @foreach($carreras as $carrera)

            <option
                value="{{ $carrera->nombre }}"

                {{ request('carrera') == $carrera->nombre ? 'selected' : '' }}
            >

                {{ $carrera->nombre }}

            </option>

        @endforeach

    </select>

    <button type="submit">
        Filtrar
    </button>

</form>
<p>
    Carrera seleccionada:
    {{ request('carrera') }}
</p>


<br><br>

<p>
    Carrera seleccionada:
    {{ request('carrera') }}
</p>

<table border="1" cellpadding="10">

    <tr>

        <th>ID</th>
        <th>Estudiante</th>
        <th>DNI</th>
        <th>Semestre</th>
        <th>Semestre Estudiante</th>
        <th>Carrera</th>
        <th>Promedio</th>
        <th>Ranking</th>

    </tr>

    @foreach($rankings as $data)

        <tr>

            <td>{{ $data->id }}</td>
            <td>{{ $data->estudiante }}</td>
            <td>{{ $data->dni }}</td>
            <td>{{ $data->semestre }}</td>
            <td>{{ $data->semestre_estudiante }}</td>
            <td>{{ $data->carrera }}</td>
            <td>{{ $data->promedio }}</td>
            <td>{{ $data->ranking }}</td>

        </tr>

    @endforeach

</table>


</body>
</html>