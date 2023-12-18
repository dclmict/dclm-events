key:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan key:generate

routes:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan route:list

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

clear:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan cache:clear

optimize:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan optimize


info:
	@docker compose -f $(DL_DCF) exec $(DL_CN) php artisan --version
