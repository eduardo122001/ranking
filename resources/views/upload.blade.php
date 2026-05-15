<!DOCTYPE html>
<html>
<head>
    <title>Subir Excel</title>
</head>
<body>

<h2>Subir archivo Excel</h2>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label>Semestre:</label>

        <select name="semestre_id" required>
            @foreach($semestres as $semestre)
                <option value="{{ $semestre->id }}">
                    {{ $semestre->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <input type="file" name="file" required>

    <button type="submit">Subir</button>
</form>

</body>
</html>