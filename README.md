# Sistema de Ranking

---

## Ejecución en local (desarrolladores)

### 1. Clonar el repositorio e instalar dependencias
```bash
composer install
npm install
```

### 2. Configurar el archivo de entorno
```bash
copy .env.example .env
```
Edita el `.env` con tus valores locales (ver sección [Variables de entorno](#variables-de-entorno)).

### 3. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 4. Ejecutar migraciones y seeders
```bash
# Primera vez
php artisan migrate --seed

# Si quieres resetear todo desde cero
php artisan migrate:fresh --seed
```

### 5. Arrancar el servidor
```bash
# En una terminal: compila assets en tiempo real
npm run dev

# En otra terminal: levanta Laravel
php artisan serve
```

Abre tu navegador en `http://127.0.0.1:8000`.

---

## Despliegue en producción (servidor del cliente)

Estos son los comandos a ejecutar en el servidor después de hacer pull del repositorio.

### 1. Instalar dependencias
```bash
composer install --no-dev --optimize-autoloader
npm install
```

### 2. Configurar el archivo de entorno
```bash
copy .env.example .env
```
Edita el `.env` con los valores del servidor (ver sección [Variables de entorno](#variables-de-entorno)).

### 3. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 4. Compilar assets frontend
```bash
npm run build
```
> Esto genera la carpeta `/public/build` con los estilos y scripts optimizados. **No usar `npm run dev` en producción.**

### 5. Ejecutar migraciones
```bash
php artisan migrate --force
```

### 6. Optimizar la aplicación
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Variables de entorno

Copia `.env.example` a `.env` y completa los siguientes campos:

### Base de datos
Por defecto usa SQLite (no requiere configuración adicional en local):
```env
DB_CONNECTION=sqlite
```

### Google Login (OAuth 2.0)
Para que el inicio de sesión con Google funcione, cada entorno necesita sus propias credenciales:

```env
GOOGLE_CLIENT_ID="TU_CLIENT_ID.apps.googleusercontent.com"
GOOGLE_CLIENT_SECRET="TU_CLIENT_SECRET"
GOOGLE_REDIRECT_URI="http://tu-dominio.com/auth/google/callback"
```

> **Importante:** La `GOOGLE_REDIRECT_URI` debe estar registrada exactamente igual en Google Cloud Console → Credenciales → URIs de redireccionamiento autorizados. `localhost` y `127.0.0.1` son distintos para Google.

#### Cómo obtener las credenciales de Google
1. Ve a [Google Cloud Console](https://console.cloud.google.com)
2. Crea un proyecto o selecciona uno existente
3. Menú → **APIs y servicios** → **Pantalla de consentimiento de OAuth** → configúrala como *Externo*
4. Ve a **Credenciales** → **+ Crear credenciales** → **ID de cliente de OAuth**
5. Tipo de aplicación: **Aplicación web**
6. Agrega en **Orígenes de JavaScript autorizados**: `http://tu-dominio.com`
7. Agrega en **URIs de redireccionamiento autorizados**: `http://tu-dominio.com/auth/google/callback`
8. Copia el **Client ID** y **Client Secret** al `.env`
