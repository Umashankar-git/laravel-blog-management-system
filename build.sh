#!/usr/bin/env bash
composer install --no-dev --optimize-autoloader
php artisan migrate:fresh --seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache in the foreground so the Docker container doesn't exit immediately
apache2-foreground
