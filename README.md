<p align="center"><a href="https://dclm.org" target="_blank"><img src="https://dclmcloud.s3.amazonaws.com/img/logo.png" width="306.5" height="275.5"></a></p>

## DCLM Events

This is a simple laravel app to present upcoming events, flyers and details to clients. It also collects user submitted event registration data.

App url: [DCLM Events](https://events.dclm.org)

## How to Run
### Monolith architecture
- make sure [PHP 7.4](https://www.php.net/releases/7_4_0.php) is installed on your server
- make sure you have [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) installed
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

### Microservices architecture (Docker)
- run `make dev`
- run `make key`
- run `make migrate`
- run `make seed`

## Credit

App built and released by [DCLM ICT team](https://dclmict.org).
