#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ ! -d vendor ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if ! grep -q '^APP_KEY=base64:' .env; then
    php artisan key:generate --force
fi

php artisan storage:link --force 2>/dev/null || true

needs_build=0
if [ ! -f public/build/manifest.json ]; then
    needs_build=1
elif ! ls public/build/assets/app-*.js >/dev/null 2>&1; then
    needs_build=1
fi

if [ "$needs_build" -eq 1 ]; then
    if [ -f package-lock.json ]; then
        npm ci
    else
        npm install
    fi
    npm run build
fi

if git rev-parse --is-inside-work-tree >/dev/null 2>&1; then
    git checkout HEAD -- \
        public/build/assets/jquery.min.js \
        public/build/assets/jquery.mask.js \
        public/build/assets/bundle.js \
        public/build/assets/bootstrap-icons.min.css \
        public/build/images/whatsapp.png \
        public/logo.png \
        public/apple-touch-icon.png \
        public/favicon-16x16.png \
        public/favicon-32x32.png \
        public/favicon.ico \
        public/android-chrome-192x192.png \
        public/android-chrome-512x512.png \
        public/mstile-150x150.png \
        2>/dev/null || true
fi

php artisan migrate --force

php artisan view:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

chown -R www-data:www-data storage bootstrap/cache public/build 2>/dev/null || true

exec "$@"
