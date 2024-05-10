## Requirements
- [Docker](https://docs.docker.com/install)
- [Docker Compose](https://docs.docker.com/compose/install)

## Setup
1. Clone the repository.
2. Start the containers by running `docker compose up -d` in the project root.
3. Install the composer packages by running `docker compose exec laravel composer install`.
4. Build database `docker compose exec laravel php artisan migrate`.
5. Access the Laravel instance on `http://localhost` (If there is a "Permission denied" error, run `docker compose exec laravel chown -R www-data storage`).

Note: For older versions, use `docker-compose` instead of `docker compose` 
## Tests
To run the tests, use the following command:\
`docker compose exec laravel vendor/bin/phpunit`

## Database population
- If you would like to populate the database you may run Book Seeder class by using the following command:\
`docker compose exec laravel php artisan db:seed --class=BooksTableSeeder`
- The default number of books generated is set to `17`, but you may change the quantity by adding `SEEDER_LIMIT` parameter.\
For example: `docker compose exec --env SEEDER_LIMIT=25 laravel php artisan db:seed --class=BooksTableSeeder`
- To restart the database without any entry run the following command:\
`docker compose exec laravel php artisan migrate:refresh`
