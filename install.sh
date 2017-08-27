composer install --optimize-autoloader

php artisan key:generate
php artisan migrate --seed
php artisan optimize
php artisan route:optimize
php artisan cache:clear

npm install
npm run prod