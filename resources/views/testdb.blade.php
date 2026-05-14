<!DOCTYPE html>
<html>
<head>
    <title>Test DB ranking_estudiantes</title>
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



<p>creacion de tablas<p>
@php // idea de obtener una tabla completa
    use Illuminate\Support\Facades\DB;

    $rankings = DB::table('ranking_view')->get(); //SELECT * FROM ranking_view;
@endphp
 <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>estudiante</th>

            <th>DNI</th>
            <th>semestre</th>
            <th>semestre_estudiante</th>
            <th>carrera</th>
            <th>rendimiento</th>
            <th>comportamiento</th>
            <th>pagos</th>
            <th>referente</th>
            <th>promedio</th>
            <th>ranking</th>

        </tr>

        @foreach($rankings as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->estudiante }}</td>
                <td>{{ $data->dni }}</td>
                <td>{{ $data->semestre }}</td>
                <td>{{ $data->semestre_estudiante }}</td>
                <td>{{ $data->carrera }}</td>
                <td>{{ $data->rendimiento }}</td>
                <td>{{ $data->comportamiento }}</td>
                <td>{{ $data->pagos }}</td>
                <td>{{ $data->referente }}</td>
                <td>{{ $data->promedio }}</td>
                <td>{{ $data->ranking }}</td>
            </tr>
        @endforeach

    </table>


<h1>Crear Usuario</h1>

    <form method="POST" action="/testdb">

        @csrf

        <div>
            <label>Nombre</label>
            <br>
            <input type="text" name="nombre" required>
        </div>

        <br>

        <div>
            <label>Email</label>
            <br>
            <input type="email" name="email" required>
        </div>

        <br>

        <div>
            <label>DNI</label>
            <br>
            <input type="text" name="dni" required>
        </div>

        <br>

        <div>
            <label>Rol</label>
            <br>

            <select name="rol_id" required>

                @foreach($roles as $rol)

                    <option value="{{ $rol->id }}">
                        {{ $rol->nombre }}
                    </option>

                @endforeach

            </select>

        </div>

        <br>

        <button type="submit">
            Guardar Usuario
        </button>

    </form>



</body>
</html>