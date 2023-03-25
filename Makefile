git:
	@git_status=$(git status --porcelain); \
	if [[ $git_status =~ \?\? ]]; then \
		git add .; \
		echo "\033[31mNew files will be added - Please enter commit message:\033[0m"; \
		read msg1; \
		git commit -m "$msg1"; \
	else \
		echo "\033[31mNo new files - Please enter commit message:\033[0m"; \
		read msg2; \
		git commit -am "$msg2"; \
	fi

build:
	@if docker images | grep -q opeoniye/dclm-events; then \
		echo "Removing \033[31mopeoniye/dclm-events\033[0m image"; \
		echo y | docker image prune --filter="dangling=true"; \
		docker image rm opeoniye/dclm-events; \
		echo "Building \033[31mopeoniye/dclm-events\033[0m image"; \
		docker build -t opeoniye/dclm-events:latest .; \
		docker images | grep opeoniye/dclm-events; \
	else \
		echo "Building \033[31mopeoniye/dclm-events\033[0m image"; \
		docker build -t opeoniye/dclm-events:latest .; \
		docker images | grep opeoniye/dclm-events; \
	fi

push:
	cat ops/docker/pin | docker login -u opeoniye --password-stdin
	docker push opeoniye/dclm-events:latest

up:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env up --detach

dev:
	cp ./ops/.env.dev ./src/.env
	cp ./docker-dev.yml ./src/docker-compose.yml
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env up -d

prod:
	cp ./ops/.env.prod ./src/.env
	cp ./docker-prod.yml ./src/docker-compose.yml
	docker pull opeoniye/dclm-events:latest
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env up -d

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
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec -it events-app bash

composer:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-app composer install

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

info:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env exec events-app php artisan --version

log:
	docker compose -f ./src/docker-compose.yml --env-file ./src/.env logs -f events-app