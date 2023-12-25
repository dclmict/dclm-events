key:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan key:generate

routes:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan route:list

storage:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan storage:link

migrate:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan migrate

migrate-fresh:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan migrate:fresh

seed:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan db:seed

tinker:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan tinker

clear:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan cache:clear

optimize:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan optimize


info:
	@docker compose -f $(COMPOSE_FILE) exec $(APP_ID) php artisan --version
