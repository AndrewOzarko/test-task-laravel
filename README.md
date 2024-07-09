cp .env.example .env

docker compose up -d

docker compose exec --user 1000 laravel.test bash

composer install

php artisan migrate

php artisan app:import-csv

http://localhost/horizon