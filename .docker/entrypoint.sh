#!/bin/bash

if [ -f artisan ]; then
    php artisan migrate --force
    php artisan storage:link
    php artisan config:cache
    php artisan route:cache
    php artisan view:clear
    php-fpm
fi