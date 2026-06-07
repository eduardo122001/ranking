# Inicialización del Proyecto

### 1. Clonar el repositorio e instalar dependencias
```bash
# Instalar dependencias de PHP
composer install

# Instalar dependencias de JavaScript (Tailwind, Vite, etc.)
npm install
```

### 2. Configurar el archivo de entorno
Duplica el archivo de ejemplo .env.example y renómbralo a .env:
```bash
cp .env.example .env
```

### 3. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 4. Ejecutar Migraciones y Seeders
Crea las tablas en tu base de datos junto con los datos base (roles, semestres iniciales, pesos, etc.):
```Bash
php artisan migrate --seed
```

### 5. Compilar assets frontend y arrancar el servidor
```Bash
# Compilar estilos y scripts en tiempo real
npm run dev

# En otra terminal, levanta el servidor de Laravel (si no usas el dominio automático de Herd)
php artisan serve
```

# Configuración de Google Login (OAuth 2.0)
Para que el inicio de sesión con Google funcione en tu PC local, cada desarrollador debe configurar sus propias credenciales en la consola de Google:

### Paso 1: Crear Credenciales en Google Cloud
Ve a la Google Cloud Console.

Crea un proyecto nuevo o selecciona uno existente.

En el menú de la izquierda, ve a API y servicios > Pantalla de consentimiento de OAuth, configúrala como Externo y llena los datos básicos.

Ve a Credenciales, haz clic en + Crear credenciales y selecciona ID de cliente de OAuth.

Selecciona Aplicación web como tipo de aplicación.

### Paso 2: Configurar las URIs Locales
Dentro de la configuración del ID de cliente de OAuth que acabas de crear, añade lo siguiente según tu entorno:

Orígenes de JavaScript autorizados:

http://localhost:8000 (O tu URL local de Laravel Herd, por ejemplo: http://ranking-login.test)

URIs de redireccionamiento autorizados:

http://localhost:8000/auth/google/callback (O tu URL de Herd: http://ranking-login.test/auth/google/callback)

### Paso 3: Actualizar el archivo .env
Copia el Client ID y el Client Secret que te dio Google y pégalos al final de tu archivo .env:
```Bash
GOOGLE_CLIENT_ID="TU_CLIENT_ID_DE_GOOGLE.apps.googleusercontent.com"
GOOGLE_CLIENT_SECRET="TU_CLIENT_SECRET_DE_GOOGLE"
GOOGLE_REDIRECT_URI="http://localhost:8000/auth/google/callback"
```
