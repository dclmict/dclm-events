<p align="center"><a href="https://dclm.org" target="_blank"><img src="https://dclmcloud.s3.amazonaws.com/img/logo.png" width="206.5" height="190"></a></p>

## DCLM Events

This is a simple laravel app to present upcoming events, flyers and details to clients. It also collects user submitted event registration data.

App url: [DCLM Events](https://events.dclm.org)

## How to Run
### Monolith architecture
- make sure [PHP 7.4](https://www.php.net/manual/en/install.php) is installed on your server
- make sure you have [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) installed
- create a directory: `mkdir -p <directory-name>`
- run `git clone https://github.com/dclmict/dclm-events.git .`
- enter app directory `cd app`
- create .env file `cp .env.example .env`
- add aws credentials to .env file
- add database credentials to .env file
- install dependencies `composer install`
- run `php artisan key:generate`
- run `php artisan migrate`
- run `php artisan db:seed`
- run `php artisan storage:link`
- run `php artisan optimize:clear`
- run `php artisan serve`

### Microservices architecture (Docker)
- make sure you have [docker compose](https://docs.docker.com/compose/install/) installed
- make sure [PHP 7.4](https://www.php.net/releases/7_4_0.php) is installed on your server
- make sure you have [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) installed
- create a directory: `mkdir -p <directory-name>`
- run `git clone https://github.com/dclmict/dclm-events.git .`
- run `make up` (wait for like 2mins for the container to boot and load properly)
- run `make key`
- run `make migrate`
- run `make seed`
- run `make storage`
- run `make log`

## Credit

App built and released by [DCLM ICT team](https://dclmict.org).
