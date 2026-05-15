## Flujo
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve (si es que no estas usando los sites de Herd)

http://frontend-fab.test/dashboard (Dashboard de estudiante)
http://frontend-fab.test/upload (Subida de excel)


Si hay error en run dev:
La APP_URL de .env debe ser
APP_URL=http://frontend-fab.test

o bien si NO usas herd sites:
APP_URL=http://127.0.0.1:8000
