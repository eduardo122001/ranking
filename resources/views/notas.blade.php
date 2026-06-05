<h1>Mis Notas</h1>

@foreach($notas as $nota)

    <p>
        Promedio:
        {{ $nota->promedio }}
    </p>

@endforeach