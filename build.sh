#!/usr/bin/env bash
# Exit on error
set -o errexit

echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

echo "Clearing old caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "Caching configurations for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running database migrations..."
# --force flag is required to run migrations in production
php artisan migrate --force

echo "Deployment build completed successfully!"
