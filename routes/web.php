<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesoController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SemestreController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');

    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
});

// Google login

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');



// Rutas exclusiva para TUTOR (rol_id = 3)
Route::middleware(['auth', 'role:3'])->prefix('tutor')->name('tutor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('tutor.dashboard');
    })->name('dashboard');
    Route::get('/rankinglist', [RankingController::class, 'index'])
        ->name('ranking.index');

    Route::get('/usuarios', [UsuarioController::class, 'index'])
        ->name('usuarios.index');

    Route::get('/usuarios/create', [UsuarioController::class, 'create'])
        ->name('usuarios.create');

    Route::post('/usuarios', [UsuarioController::class, 'store'])
        ->name('usuarios.store');

    Route::get('/usuarios/{user}/edit', [UsuarioController::class, 'edit'])
        ->name('usuarios.edit');

    Route::put('/usuarios/{user}', [UsuarioController::class, 'update'])
        ->name('usuarios.update');

    Route::delete('/usuarios/{user}', [UsuarioController::class, 'destroy'])
        ->name('usuarios.destroy');

    Route::get('/upload', [NotaController::class, 'form'])->name('upload.index');
    Route::post('/upload', [NotaController::class, 'upload'])->name('upload.load');
});


// Rutas exclusiva para SUPERVISOR (rol_id = 2)
Route::middleware(['auth', 'role:2'])->prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('supervisor.dashboard');
    })->name('dashboard');
    Route::get('/rankinglist', [RankingController::class, 'index'])
        ->name('ranking.index');
});


//// Rutas exclusiva para Superadministrador ID = 1
Route::middleware(['auth', 'role:1'])->prefix('superadministrador')->name('superadministrador.')->group(function () {

    Route::get('/dashboard', function () {
        return view('superadministrador.dashboard');
    })->name('dashboard');
    Route::get('/pesos', [PesoController::class, 'index'])
        ->name('pesos.index');

    Route::post('/pesos/update', [PesoController::class, 'update'])
        ->name('pesos.update');

    Route::get('/semestres', [SemestreController::class, 'index'])
        ->name('semestres.index');
    Route::post('/semestres', [SemestreController::class, 'store'])
        ->name('semestres.store');
    Route::delete('/semestres/{semestre}', [SemestreController::class, 'destroy'])
    ->name('semestres.destroy');

    Route::get('/rankinglist', [RankingController::class, 'index'])
        ->name('ranking.index');

    Route::get('/usuarios', [UsuarioController::class, 'index'])
        ->name('usuarios.index');

    Route::get('/usuarios/create', [UsuarioController::class, 'create'])
        ->name('usuarios.create');

    Route::post('/usuarios', [UsuarioController::class, 'store'])
        ->name('usuarios.store');

    Route::get('/usuarios/{user}/edit', [UsuarioController::class, 'edit'])
        ->name('usuarios.edit');

    Route::put('/usuarios/{user}', [UsuarioController::class, 'update'])
        ->name('usuarios.update');

    Route::delete('/usuarios/{user}', [UsuarioController::class, 'destroy'])
        ->name('usuarios.destroy');

    Route::get('/reportes', [LogController::class, 'index'])
        ->name('reportes.index');
});


require __DIR__ . '/auth.php';
