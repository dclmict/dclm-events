# Start app engine
run-app:
	@\
	echo -e "Starting container in \033[32m$$(hostname)\033[0m environment..."; \
  os=$$(hostname); \
  if [ "$$os" = "dclm" ]; then \
    make -s compose-dclm-prod; \
		docker pull $(DK_IMAGE); \
		docker compose -f $(COMPOSE_FILE) up -d; \
	fi; \
  if [ "$$os" = "dclmict" ]; then \
    make -s compose-dclm-dev; \
		docker pull $(DK_IMAGE); \
		docker compose -f $(COMPOSE_FILE) up -d; \
	fi; \
  if [[ "$$os" != "dclm" && "$$os" != "dclmict" ]]; then \
		make -s compose-bams; \
		docker compose -f $(COMPOSE_FILE) up -d; \
  fi

new:
	@git restore .
	@git pull

down:
	@docker compose -f $(COMPOSE_FILE) down

start:
	@docker compose -f $(COMPOSE_FILE) start

restart:
	@docker compose -f $(COMPOSE_FILE) restart

stop:
	@docker compose -f $(COMPOSE_FILE) stop

ps:
	@docker compose -f $(COMPOSE_FILE) ps

stat:
	@docker compose -f $(COMPOSE_FILE) top

log:
	@docker compose -f $(COMPOSE_FILE) logs -f $(APP_ID)

sh:
	@docker compose -f $(COMPOSE_FILE) exec -it $(APP_ID) bash

compose-bams:
	@echo "Generating docker-compose.yml..."
	@echo "services:" > ./src/docker-compose.yml
	@echo "  $(APP_ID):" >> ./src/docker-compose.yml
	@echo "    container_name: \$${APP_ID}" >> ./src/docker-compose.yml
	@echo "    image: \$${DK_IMAGE}" >> ./src/docker-compose.yml
	@echo "    env_file: .env" >> ./src/docker-compose.yml
	@echo "    ports:" >> ./src/docker-compose.yml
	@echo "      - $(COMPOSE_PORT)" >> ./src/docker-compose.yml
	@echo "    networks:" >> ./src/docker-compose.yml
	@echo "      - $(COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    working_dir: /var/www" >> ./src/docker-compose.yml
	@echo "    restart: unless-stopped" >> ./src/docker-compose.yml
	@echo "    labels:" >> ./src/docker-compose.yml
	@echo "      logging: '"promtail"'" >> ./src/docker-compose.yml
	@echo "      logging_jobname: '"containerlogs"'" >> ./src/docker-compose.yml
	@echo "    volumes:" >> ./src/docker-compose.yml
	@echo "      - .:/var/www" >> ./src/docker-compose.yml
	@echo "      - $(NGX_CERT):/var/ssl/cert.pem" >> ./src/docker-compose.yml
	@echo "      - $(NGX_CERT_KEY):/var/ssl/key.pem" >> ./src/docker-compose.yml
	@echo "networks:" >> ./src/docker-compose.yml
	@echo "  $(COMPOSE_NETWORK):" >> ./src/docker-compose.yml
	@echo "    name: $(COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    external: true" >> ./src/docker-compose.yml
	@echo "Docker-compose file generated successfully."

compose-dclm-dev:
	@echo "Generating docker-compose.yml..."
	@echo "services:" > ./src/docker-compose.yml
	@echo "  $(APP_ID):" >> ./src/docker-compose.yml
	@echo "    container_name: \$${APP_ID}" >> ./src/docker-compose.yml
	@echo "    image: \$${DK_IMAGE}" >> ./src/docker-compose.yml
	@echo "    env_file: .env" >> ./src/docker-compose.yml
	@echo "    ports:" >> ./src/docker-compose.yml
	@echo "      - $(COMPOSE_PORT)" >> ./src/docker-compose.yml
	@echo "    networks:" >> ./src/docker-compose.yml
	@echo "      - $(COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    volumes:" >> ./src/docker-compose.yml
	@echo "      - $(NGX_CERT):/var/ssl/cert.pem" >> ./src/docker-compose.yml
	@echo "      - $(NGX_CERT_KEY):/var/ssl/key.pem" >> ./src/docker-compose.yml
	@echo "    restart: always" >> ./src/docker-compose.yml
	@echo "    working_dir: /var/www" >> ./src/docker-compose.yml
	@echo "networks:" >> ./src/docker-compose.yml
	@echo "  $(COMPOSE_NETWORK):" >> ./src/docker-compose.yml
	@echo "    name: $(COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    external: true" >> ./src/docker-compose.yml
	@echo "Docker-compose file generated successfully."

compose-dclm-prod:
	@echo "Generating docker-compose.yml..."
	@echo "services:" > ./src/docker-compose.yml
	@echo "  $(APP_ID):" >> ./src/docker-compose.yml
	@echo "    container_name: \$${APP_ID}" >> ./src/docker-compose.yml
	@echo "    image: \$${DK_IMAGE}" >> ./src/docker-compose.yml
	@echo "    env_file: .env" >> ./src/docker-compose.yml
	@echo "    ports:" >> ./src/docker-compose.yml
	@echo "      - $(COMPOSE_PORT)" >> ./src/docker-compose.yml
	@echo "    networks:" >> ./src/docker-compose.yml
	@echo "      - $(COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    volumes:" >> ./src/docker-compose.yml
	@echo "      - $(NGX_CERT):/var/ssl/cert.pem" >> ./src/docker-compose.yml
	@echo "      - $(NGX_CERT_KEY):/var/ssl/key.pem" >> ./src/docker-compose.yml
	@echo "    restart: always" >> ./src/docker-compose.yml
	@echo "    working_dir: /var/www" >> ./src/docker-compose.yml
	@echo "networks:" >> ./src/docker-compose.yml
	@echo "  $(COMPOSE_NETWORK):" >> ./src/docker-compose.yml
	@echo "    name: $(COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    external: true" >> ./src/docker-compose.yml
	@echo "Docker-compose file generated successfully."