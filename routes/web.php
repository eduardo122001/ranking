<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;    
use App\Http\Controllers\NotaController;


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

Route::get('/upload', [NotaController::class, 'form']);

Route::post('/upload', [NotaController::class, 'upload']);