#!/bin/bash
composer install --optimize-autoloader
php artisan key:generate
php artisan migrate --seed
npm install
npm run production