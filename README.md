# Building a Laravel API with TDD

## Getting Started
### Prerequisites

#### Docker

* [Windows and Mac](https://www.docker.com/products/docker-desktop)
* [Linux](https://docs.docker.com/engine/install/ubuntu/)

### Installing

```
git clone git@github.com:fredyhenaodev/laravel-api-tdd.git

cd /laravel-api-tdd/docker

docker-compose build

docker-compose up -d

docker-compose exec php-fpm bash

cd /var/www

composer install
```

## Running the tests

```
cd /laravel-api-tdd/docker

docker-compose exec php-fpm bash

cd /var/www

php artisan test
```