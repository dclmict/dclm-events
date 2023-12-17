# Start app engine
run-app:
	@\
	echo -e "Starting container in \033[32m$$(hostname)\033[0m environment..."
  os=$$(hostname); \
  if [ "$$os" = "dclm" ]; then \
    make -s compose-dclm-prod; \
		docker pull $(DL_DIN); \
		docker compose -f $(DL_DCF) up -d; \
	fi; \
  if [ "$$os" = "dclmict" ]; then \
    make -s compose-dclm-dev; \
		docker pull $(DL_DIN); \
		docker compose -f $(DL_DCF) up -d; \
	fi; \
  if [[ "$$os" != "dclm" && "$$os" != "dclmict" ]]; then \
		make -s compose-bams-dev; \
		docker compose -f $(DL_DCF) up -d; \
  fi

down:
	@docker compose -f $(DL_DCF) down

start:
	@docker compose -f $(DL_DCF) start

restart:
	@docker compose -f $(DL_DCF) restart

stop:
	@docker compose -f $(DL_DCF) stop

ps:
	@docker compose -f $(DL_DCF) ps

stat:
	@docker compose -f $(DL_DCF) top

log:
	@docker compose -f $(DL_DCF) logs -f $(DL_CN)

sh:
	@docker compose -f $(DL_DCF) exec -it $(DL_CN) bash

compose-bams-dev:
	@echo "Generating docker-compose.yml..."
	@echo "services:" > ./src/docker-compose.yml
	@echo "  $(DL_CN):" >> ./src/docker-compose.yml
	@echo "    container_name: \$${DL_CN}" >> ./src/docker-compose.yml
	@echo "    image: \$${DL_DIN}" >> ./src/docker-compose.yml
	@echo "    env_file: .env" >> ./src/docker-compose.yml
	@echo "    ports:" >> ./src/docker-compose.yml
	@echo "      - $(DL_COMPOSE_PORT)" >> ./src/docker-compose.yml
	@echo "    networks:" >> ./src/docker-compose.yml
	@echo "      - $(DL_COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    working_dir: /var/www" >> ./src/docker-compose.yml
	@echo "    restart: unless-stopped" >> ./src/docker-compose.yml
	@echo "    labels:" >> ./src/docker-compose.yml
	@echo "      logging: promtail" >> ./src/docker-compose.yml
	@echo "      logging_jobname: containerlogs" >> ./src/docker-compose.yml
	@echo "    volumes:" >> ./src/docker-compose.yml
	@echo "      - .:/var/www" >> ./src/docker-compose.yml
	@echo "      - $(DL_CERT):/var/ssl/cert.pem" >> ./src/docker-compose.yml
	@echo "      - $(DL_CERT_KEY):/var/ssl/key.pem" >> ./src/docker-compose.yml
	@echo "networks:" >> ./src/docker-compose.yml
	@echo "  $(DL_COMPOSE_NETWORK):" >> ./src/docker-compose.yml
	@echo "    name: $(DL_COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    external: true" >> ./src/docker-compose.yml
	@echo "Docker-compose file generated successfully."

compose-dclm-dev:
	@echo "Generating docker-compose.yml..."
	@echo "services:" > ./src/docker-compose.yml
	@echo "  $(DL_CN):" >> ./src/docker-compose.yml
	@echo "    container_name: \$${DL_CN}" >> ./src/docker-compose.yml
	@echo "    image: \$${DL_DIN}" >> ./src/docker-compose.yml
	@echo "    env_file: .env" >> ./src/docker-compose.yml
	@echo "    ports:" >> ./src/docker-compose.yml
	@echo "      - $(DL_COMPOSE_PORT)" >> ./src/docker-compose.yml
	@echo "    networks:" >> ./src/docker-compose.yml
	@echo "      - $(DL_COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    volumes:" >> ./src/docker-compose.yml
	@echo "      - $(DL_CERT):/var/ssl/cert.pem" >> ./src/docker-compose.yml
	@echo "      - $(DL_CERT_KEY):/var/ssl/key.pem" >> ./src/docker-compose.yml
	@echo "    restart: always" >> ./src/docker-compose.yml
	@echo "    working_dir: /var/www" >> ./src/docker-compose.yml
	@echo "networks:" >> ./src/docker-compose.yml
	@echo "  $(DL_COMPOSE_NETWORK):" >> ./src/docker-compose.yml
	@echo "    name: $(DL_COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    external: true" >> ./src/docker-compose.yml
	@echo "Docker-compose file generated successfully."

compose-dclm-prod:
	@echo "Generating docker-compose.yml..."
	@echo "services:" > ./src/docker-compose.yml
	@echo "  $(DL_CN):" >> ./src/docker-compose.yml
	@echo "    container_name: \$${DL_CN}" >> ./src/docker-compose.yml
	@echo "    image: \$${DL_DIN}" >> ./src/docker-compose.yml
	@echo "    env_file: .env" >> ./src/docker-compose.yml
	@echo "    ports:" >> ./src/docker-compose.yml
	@echo "      - $(DL_COMPOSE_PORT)" >> ./src/docker-compose.yml
	@echo "    networks:" >> ./src/docker-compose.yml
	@echo "      - $(DL_COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    volumes:" >> ./src/docker-compose.yml
	@echo "      - $(DL_CERT):/var/ssl/cert.pem" >> ./src/docker-compose.yml
	@echo "      - $(DL_CERT_KEY):/var/ssl/key.pem" >> ./src/docker-compose.yml
	@echo "    restart: always" >> ./src/docker-compose.yml
	@echo "    working_dir: /var/www" >> ./src/docker-compose.yml
	@echo "networks:" >> ./src/docker-compose.yml
	@echo "  $(DL_COMPOSE_NETWORK):" >> ./src/docker-compose.yml
	@echo "    name: $(DL_COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    external: true" >> ./src/docker-compose.yml
	@echo "Docker-compose file generated successfully."