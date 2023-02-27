up:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env up --detach

build:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env up --detach --build

down:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env down

start:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env start

stop:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env stop

restart:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env.dev restart

destroy:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env down --volumes

shell:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec -it events-src sh

key:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-src php artisan key:generate

storage:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-src php artisan storage:link

migrate:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-src php artisan migrate

fresh:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-src php artisan migrate:fresh

seed:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-src php artisan db:seed

db:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-src php artisan tinker

version:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-src php artisan --version

log:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env logs -f events-src