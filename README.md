# sales-dashboard
A simple sales dashboard created Laravel. Includes resources for deployment in Docker and Kubernetes.

## Setup
Spin up the containers.
`docker-compose up`

Run migrations.
`docker-compose exec app php artisan migrate`

Seed the database.
`docker-compose exec app php artisan db:seed`

## TODO
* Handle secrets in docker-compose.yml.
* Kubernetes testing.
* Script setup for development.
