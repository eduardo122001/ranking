<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PesoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])  
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Upload
    Route::get('/upload', [NotaController::class, 'form']);

    Route::post('/upload', [NotaController::class, 'upload']);

});

// Google login

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

//Route::get('/login', fn() => view('auth.login'))->name('login');

/*Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/login');

})->name('logout');*/

Route::get('/pesos', [PesoController::class, 'index'])
    ->name('pesos.index');

Route::post('/pesos/update', [PesoController::class, 'update'])
    ->name('pesos.update');

require __DIR__.'/auth.php';