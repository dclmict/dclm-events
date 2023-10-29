key:
	@docker compose -f $(DCF) exec $(CN) php artisan key:generate

storage:
	@docker compose -f $(DCF) exec $(CN) php artisan storage:link

migrate:
	@docker compose -f $(DCF) exec $(CN) php artisan migrate

migrate-fresh:
	@docker compose -f $(DCF) exec $(CN) php artisan migrate:fresh

seed:
	@docker compose -f $(DCF) exec $(CN) php artisan db:seed

tinker:
	@docker compose -f $(DCF) exec $(CN) php artisan tinker

info:
	@docker compose -f $(DCF) exec $(CN) php artisan --version
