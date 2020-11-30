# sales-dashboard
A project for experimentation with web development tools.

## Setup
Spin up the containers.
`docker-compose up`

Run migrations.
`docker-compose exec app php artisan migrate`

Seed the database.
`docker-compose exec app php artisan db:seed`
