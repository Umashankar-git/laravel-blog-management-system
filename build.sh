#!/bin/bash

# Clear existing cache before starting
php artisan optimize:clear

# Cache configuration, routes, and views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations and seeding
php artisan migrate --force
php artisan db:seed --force

# Start the web server in the foreground
apache2-foreground
