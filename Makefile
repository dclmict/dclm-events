up:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env up --detach

dev:
	cp ./ops/.env.dev ./src/.env
	cp ./docker-dev.yml ./src/docker-compose.yml
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env up -d

prod:
	cp ./ops/.env.prod ./src/.env
	cp ./docker-prod.yml ./src/docker-compose.yml
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env up -d

build:
	docker build -t opeoniye/dclm-events:latest . && docker images | grep opeoniye/dclm-events

push:
	cat ops/docker/pin | docker login -u opeoniye --password-stdin
	docker push opeoniye/dclm-events:latest

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
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec -it events-app sh

composer:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec testimony-app composer install

key:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-app php artisan key:generate

storage:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-app php artisan storage:link

migrate:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-app php artisan migrate

fresh:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-app php artisan migrate:fresh

seed:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-app php artisan db:seed

db:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-app php artisan tinker

version:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-app php artisan --version

log:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env logs -f events-app