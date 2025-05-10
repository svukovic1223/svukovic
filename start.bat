@echo off
composer install

if not exist ".env" (
    copy .env.example .env
)

php artisan key:generate
php artisan storage:link
php artisan migrate:fresh --seed

start http://localhost:8000
php artisan serve
