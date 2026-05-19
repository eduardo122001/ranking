# inicializacion db(caso error borrar y crear la db nuevamente)
1)hacer en el cmd -> php artisan migrate:fresh
2)hacer en el cmd -> php artisan db:seed
3)correr el programa http:/tucoso/upload
4)colocar el excel
5)yata

#CAMBIOS DEL 19/05/2026 LOGIN PASOS

TODO LO QUE SEA MODIFICAR EL CODIGO YA ESTA, solo tienen que crear el google cloud y cambiar el env, tambien ejecutar los comandos de herd link y eso

Paso 1: Instalar Laravel Socialite Ejecuta el siguiente comando en la terminal dentro de tu proyecto: composer require laravel/socialite

Paso 2: Crear credenciales en Google Cloud Console Ingresa a https://console.cloud.google.com y sigue estos pasos: Ve a APIs & Services > Credentials Clic en Create Credentials > OAuth 2.0 Client ID Tipo de aplicacion: Web application En Authorized redirect URIs agrega: https://localhost/auth/google/callback Copia el Client ID y Client Secret generados

Paso 3: Configurar el archivo .env Agrega las credenciales de Google en tu archivo .env: GOOGLE_CLIENT_ID=tu-client-id ////////////////////otra linea////////////////////////// GOOGLE_CLIENT_SECRET=tu-client-secret ////////////////otra linea////////////////////////////// GOOGLE_REDIRECT_URI=https://localhost/auth/google/callback

Paso 4: Registrar el servicio en config/services.php 'google' => [ 'client_id' => env('GOOGLE_CLIENT_ID'), 'client_secret' => env('GOOGLE_CLIENT_SECRET'), 'redirect' => env('GOOGLE_REDIRECT_URI'), ],

Paso 5: Agregar columnas a la tabla users// OMITIR ESTA PARTE, INNECESARIA

Paso 6: Crear el GoogleController php artisan make:controller Auth/GoogleController El controlador solo busca el usuario por email (sin crear nuevos registros): $googleUser = Socialite::driver('google')->user(); $user = User::where('email', $googleUser->getEmail())->first(); if (!$user) { return redirect('/login')->with('error', 'Usuario no aceptado.'); } Auth::login($user); return redirect()->intended('/dashboard');

Paso 7: Definir las rutas en routes/web.php Route::get('/login', fn() => view('auth.login'))->name('login'); Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect'); Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Paso 8: Crear la vista de login Guarda el archivo Blade en: resources/views/auth/login.blade.php La vista incluye el boton 'Continuar con Google' y muestra mensajes de error de sesion.

Paso 9: Habilitar HTTPS con Herd Google requiere HTTPS incluso en entornos locales. Ejecuta en el cmd: 0) herd link localhost

herd trust
herd secure localhost Luego accede a tu app desde: https://localhost/login
Paso 10: Compilar assets Asegurate de tener Tailwind compilado mientras desarrollas: npm install npm run dev

Notas importantes Google no acepta dominios .test como redirect URI, usar https://localhost php artisan serve no funciona con Herd activo (conflicto de puertos) Despues de editar el .env siempre correr: php artisan config:clear Si un campo obligatorio en users falla, hacerlo nullable en la migracion En produccion cambiar la redirect URI a https://tudominio.com/auth/google/callback
