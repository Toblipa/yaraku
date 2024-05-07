## Requirements
- [Docker](https://docs.docker.com/install)
- [Docker Compose](https://docs.docker.com/compose/install)

## Setup
1. Clone the repository.
2. Start the containers by running `docker-compose up -d` in the project root.
3. Install the composer packages by running `docker-compose exec laravel composer install`.
4. Access the Laravel instance on `http://localhost` (If there is a "Permission denied" error, run `docker-compose exec laravel chown -R www-data storage`).
5. Build database `docker compose exec laravel php artisan migrate`.

Note that the changes you make to local files will be automatically reflected in the container. 

## Tests
To run the tests, run the following command line: `docker compose exec laravel vendor/bin/phpunit`.

## Persistent database
If you want to make sure that the data in the database persists even if the database container is deleted, add a file named `docker-compose.override.yml` in the project root with the following contents.
```
version: "3.7"

services:
  mysql:
    volumes:
    - mysql:/var/lib/mysql

volumes:
  mysql:
```
Then run the following.
```
docker-compose stop \
  && docker-compose rm -f mysql \
  && docker-compose up -d
``` 
