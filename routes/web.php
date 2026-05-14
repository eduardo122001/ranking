<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;    
use App\Http\Controllers\NotaController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $user = Socialite::driver('google')->user();
 
    // $user->token
});

// estas son las rutas usadas para la prueba de la base de datos 
// mostrar datos de una tabla y agregar datos a tabla usuarios
Route::get('/testdb', function () {

    $roles = DB::table('roles')->get();

    return view('testdb', compact('roles'));
});

Route::post('/testdb', function (Request $request) {
    // forma de agregar a una tabla datos 
    DB::table('usuarios')->insert([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'dni' => $request->dni,
        'rol_id' => $request->rol_id
    ]);

    return redirect('/testdb');

});
// uso de filtros por medio de carrera
Route::get('/testdb2', function (Request $request) {

    $carreras = DB::table('carreras')->get();

    $query = DB::table('ranking_view');

    if ($request->carrera) {

        $query->where('carrera', $request->carrera);

    }

    $rankings = $query->get();

    return view('testdb2', compact(
        'rankings',
        'carreras'
    ));
});

//actualizaciones para la tabla notas para administrador o un intento de actualizar datos de una tabla
Route::get('/testdb3', function () {

    $rankings = DB::table('ranking_view')->get();

    return view('testdb3', compact('rankings'));

});
Route::post('/testdb3/update/{id}', function (
    Request $request,
    $id
) {
    
    DB::table('notas')
        ->where('id', $id)
        ->update([

            'rendimiento' => $request->rendimiento,
            'comportamiento' => $request->comportamiento,
            'pagos' => $request->pagos,
            'referente' => $request->referente

        ]);

    return redirect('/testdb3');

});
// mostrar datos de un estudiante en especifico con su historial
// fin de rutas de prueba de la base de datos 
Route::get('/upload', [NotaController::class, 'form']);

Route::post('/upload', [NotaController::class, 'upload']);


