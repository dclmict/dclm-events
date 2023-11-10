key:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan key:generate

storage:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan storage:link

migrate:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan migrate

migrate-fresh:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan migrate:fresh

seed:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan db:seed

tinker:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan tinker

info:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan --version
