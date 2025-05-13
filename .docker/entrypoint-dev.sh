#!/bin/bash

if [ -f artisan ]; then
    composer install --optimize-autoloader
    php artisan storage:link
    php artisan config:cache
    php artisan route:cache
    php artisan view:clear
    npm i && npm run build
    php artisan migrate --seed
    php-fpm
fi