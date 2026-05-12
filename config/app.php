<?php

return [
    'name' => env('APP_NAME', 'Blog Management System'),
    'env' => env('APP_ENV', 'local'),
    'debug' => (bool) env('APP_DEBUG', true),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => 'Asia/Kolkata',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
    'maintenance' => [
        'driver' => 'file',
    ],
    'providers' => Illuminate\Support\ServiceProvider::defaultProviders()->toArray(),
    'aliases' => Illuminate\Support\Facades\Facade::defaultAliases()->toArray(),
];
