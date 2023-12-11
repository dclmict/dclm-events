# https://makefiletutorial.com/

# load env file
include ./src/.env

SHELL := /bin/bash

# copy .env file based on environment (prompt)
.PHONY: env
env:
	@os=$$(hostname); \
	if [ "$$os" = "dclm" ]; then \
		cp ./ops/dclm-prod.env ./src/.env; \
	elif [ "$$os" = "dclmict" ]; then \
		cp ./ops/dclm-dev.env ./src/.env; \
	else \
		chmod +x ./ops/sh/copy-env-file.sh; \
		./ops/sh/copy-env-file.sh; \
	fi

# remove double quotes
DL_STACK := $(subst ",,${DL_STACK})

# include other makefiles
ifeq ($(DL_STACK),laravel)
	include ./ops/sh/laravel.mk
endif

repo: env
	@echo "What do you want to do?:"; \
	echo "1. Create local git repo"; \
	echo "2. Create remote repo on GitHub"; \
	echo "3. Rename remote repo on GitHub"; \
	read -p "Enter a number to select your choice: " git_choice; \
	if [ $$git_choice -eq 1 ]; then \
		make repo-gitignore; \
		make repo-init; \
	elif [ $$git_choice -eq 2 ]; then \
		make repo-name; \
	elif [ $$git_choice -eq 3 ]; then \
		make repo-rename; \
	else \
		echo "Invalid choice"; \
		exit 1; \
	fi

repo-init: env
	@read -p "Do you want to initialise this folder? (yes|no): " repo_init; \
	case "$$repo_init" in \
		yes|Y|y) \
			if [ -d .git ]; then \
				echo -e "\033[31mCurrent directory already initialised \033[0m\n"; \
			else \
				echo -e "\033[32mPlease enter initial commit message: \033[0m\n"; \
				read -r commitMsg; \
				git init && git add . && git commit -m "$$commitMsg"; \
			fi \
			;; \
		no|N|n) \
			echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

repo-name: env
	@read -p "Do you want to create a github repo? (yes|no): " repo_name; \
	case "$$repo_name" in \
		yes|Y|y) \
			read -p "Enter GitHub user: " ghUser; \
			read -p "Enter GitHub repo name: " ghName; \
			chmod +x ./ops/sh/gh-repo-check.sh; \
			result="$$(./ops/sh/gh-repo-check.sh $$ghUser/$$ghName)"; \
			if [ $$result -eq 200 ]; then \
				echo -e "\033[31mGitHub repo exists. I stop here. \033[0m\n"; \
			else \
				echo "Which type of repository are you creating?:"; \
				echo "1. Private repo"; \
				echo "2. Public repo"; \
				read -p "Enter a number to select your choice: " repoType; \
				if [ $$repoType -eq 1 ]; then \
					REPO=private; \
				elif [ $$repoType -eq 2 ]; then \
					REPO=public; \
				else \
					echo "Invalid choice"; \
					exit 1; \
				fi; \
				gh repo create $$ghUser/$$ghName --$$REPO --source=. --remote=origin; \
			fi; \
			;; \
		no|N|n) \
			echo -e "\033[32mOkay. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32m No choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

repo-rename: env
	@read -p "Do you want to rename this repo? (yes|no): " repo_scan; \
	case "$$repo_scan" in \
		yes|Y|y) \
			echo -e "\033[32mRenaming repo ...\033[0m\n"; \
			chmod +x ./ops/sh/gh-repo-rename.sh; \
			./ops/sh/gh-repo-rename.sh; \
			;; \
		no|N|n) \
			echo -e "\033[32mOkay. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

repo-scan:
	@read -p "Do you want to scan this repo? (yes|no): " repo_scan; \
	case "$$repo_scan" in \
		yes|Y|y) \
			echo -e "\033[32mScanning repo for secrets...\033[0m\n"; \
			ggshield secret scan repo .; \
			;; \
		no|N|n) \
			echo -e "\033[32mOkay. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

repo-gitignore: env
	@echo '# files' > .gitignore
	@echo '.env' >> .gitignore
	@echo '.cache_ggshield' >> .gitignore
	@echo 'dclm-events' >> .gitignore
	@echo 'ops/bams-dev.env' >> .gitignore
	@echo 'ops/dclm-dev.env' >> .gitignore
	@echo 'ops/dclm-prod.env' >> .gitignore
	@echo 'ops/dclm-v1.env' >> .gitignore
	@echo '' >> .gitignore
	@echo '# folders' >> .gitignore
	@echo '_' >> .gitignore

git: env gh-envfile-set check-repo
	@if git status --porcelain | grep -q "^??"; then \
		make git-commit-new; \
		make git-push; \
	elif git status --porcelain | grep -qE '[^ADMR]'; then \
		make git-commit-old; \
		make git-push; \
	elif [ -z "$$(git status --porcelain)" ]; then \
		make git-push; \
	else \
		echo -e "\033[31m Unknown status. Aborting...\033[0m\n"; \
		exit 0; \
	fi

git-commit-new:
	@echo -e "\033[31mUntracked files found::\033[0m \033[32mPlease enter commit message:\033[0m"; \
	read -r msg1; \
	git add -A; \
	git commit -m "$$msg1"; \

git-commit-old:
	@echo -e "\033[31mModified files found...\033[0m \033[32mPlease enter commit message:\033[0m"; \
	read -r msg2; \
	git commit -am "$$msg2"

git-push: repo-scan
	@read -p "Do you want to push your commit to GitHub? (yes|no): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mPushing commit to GitHub...\033[0m\n"; \
			git push; \
			;; \
		no|N|n) \
			echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

gh-envfile-set:
	@read -p "Do you want to generate env in workflow? (yes|no): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mFilling env file in workflow...\033[0m\n"; \
			chmod +x ./ops/sh/gh-envfile-set.sh; \
			./ops/sh/gh-envfile-set.sh; \
			;; \
		no|N|n) \
			echo -e "\033[32mOkay. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

# Check if a Github repository is public or private
check-repo:
	@if [ "$$(gh repo view $(DL_REPO) --json isPrivate -q .isPrivate 2>/dev/null)" = "true" ]; then \
		echo "This repository is private"; \
		make gh-secret-private; \
		make gh-variable-private; \
	else \
		echo "This repository is public"; \
		make gh-secret-public; \
		make gh-variable-public; \
	fi

# List secrets in a Github repo
gh-secret-list:
	@gh secret list

gh-secret-private: gh-secret-private-rm
	@read -p "Do you want to set private repo secrets? (yes/y | no/n): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mSetting private repo secrets...\033[0m\n"; \
			chmod +x ./ops/sh/gh-secret.sh; \
			./ops/sh/gh-secret.sh 1 $(DL_ENV); \
			;; \
		no|N|n) \
			echo -e "\033[32mOkay. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

gh-secret-private-rm:
	@read -p "Do you want to delete private repo secrets? (yes|no): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mDeleting private repo secrets...\033[0m\n"; \
			chmod +x ./ops/sh/gh-secret.sh; \
			./ops/sh/gh-secret.sh 2 $(DL_ENV); \
			;; \
		no|N|n) \
			echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

gh-secret-public: gh-secret-public-rm
	@read -p "Do you want to set public repo secrets? (yes|no): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mSetting public repo secrets...\033[0m\n"; \
			chmod +x ./ops/sh/gh-secret.sh; \
			./ops/sh/gh-secret.sh 3 $(DL_ENV); \
			;; \
		no|N|n) \
			echo -e "\033[32mOkay. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

gh-secret-public-rm:
	@read -p "Do you want to delete public repo secrets? (yes|no): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mDeleting public repo secrets...\033[0m\n"; \
			chmod +x ./ops/sh/gh-secret.sh; \
			./ops/sh/gh-secret.sh 4 $(DL_ENV); \
			;; \
		no|N|n) \
			echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

gh-variable-private: gh-variable-private-rm
	@read -p "Do you want to set private repo variables? (yes|no): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mSetting private repo variables...\033[0m\n"; \
			chmod +x ./ops/sh/gh-secret.sh; \
			./ops/sh/gh-secret.sh; \
			;; \
		no|N|n) \
			echo -e "\033[32mOkay. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

gh-variable-private-rm:
	@read -p "Do you want to delete private repo variables? (yes|no): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mDeleting private repo variables...\033[0m\n"; \
			chmod +x ./ops/sh/gh-secret.sh; \
			./ops/sh/gh-secret.sh $(DL_ENV); \
			;; \
		no|N|n) \
			echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

gh-variable-public: gh-variable-public-rm
	@read -p "Do you want to set public repo variables? (yes|no): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mSetting public repo variables...\033[0m\n"; \
			chmod +x ./ops/sh/gh-secret.sh; \
			./ops/sh/gh-secret.sh 7 $(DL_ENV); \
			;; \
		no|N|n) \
			echo -e "\033[32mOkay. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

gh-variable-public-rm:
	@read -p "Do you want to delete public repo variables? (yes|no): " choice; \
	case "$$choice" in \
		yes|Y|y) \
			echo -e "\033[32mDeleting public repo variables...\033[0m\n"; \
			chmod +x ./ops/sh/gh-secret.sh; \
			./ops/sh/gh-secret.sh 8 $(DL_ENV); \
			;; \
		no|N|n) \
			echo -e "\033[32mNothing to be done. Thank you...\033[0m\n"; \
			exit 0; \
			;; \
		*) \
			echo -e "\033[32mNo choice. Exiting script...\033[0m\n"; \
			exit 1; \
			;; \
	esac

image: env
	@if [ "$(docker images -qf "dangling=true")" ]; then \
		echo -e "\033[31mRemoving dangling images...\033[0m"; \
		docker image prune -f; \
	fi
	@if docker image inspect $(DL_DIN) &> /dev/null; then \
		echo -e "\033[31mDeleting existing image...\033[0m"; \
		docker rmi $(DL_DIN); \
	fi
	@echo -e "\033[32mBuilding $(DL_DIN) image\033[0m"
	@docker build -t $(DL_DIN) -f $(DL_DFILE) .
	@docker images | grep $(DL_IU)/$(DL_IN)

image-push: env
	@echo ${DL_DLP} | docker login -u ${DL_DLU} --password-stdin
	@docker push $(DL_DIN)

# Create docker compose file in dev environment
create-compose-dev:
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
	@echo "      - .:/var/www" >> ./src/docker-compose.yml
	@echo "      - $(DL_CERT):/var/ssl/cert.pem" >> ./src/docker-compose.yml
	@echo "      - $(DL_CERT_KEY):/var/ssl/key.pem" >> ./src/docker-compose.yml
	@echo "    restart: always" >> ./src/docker-compose.yml
	@echo "    working_dir: /var/www" >> ./src/docker-compose.yml
	@echo "networks:" >> ./src/docker-compose.yml
	@echo "  $(DL_COMPOSE_NETWORK):" >> ./src/docker-compose.yml
	@echo "    name: $(DL_COMPOSE_NETWORK)" >> ./src/docker-compose.yml
	@echo "    external: true" >> ./src/docker-compose.yml
	@echo "Docker-compose file generated successfully."

# Create docker compose file in prod environment
create-compose-prod:
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

# Start app engine
up: env
	@echo -e "\033[31mStarting container in $(DL_ENV_ENV) environment...\033[0m"
	@if [ "$(DL_ENV_ENV)" = "bams-dev" ]; then \
		make create-compose-dev; \
		docker compose -f $(DL_DCF) up -d; \
	else \
		make create-compose-prod; \
		docker pull $(DL_DIN); \
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

stats:
	@docker compose -f $(DL_DCF) top

log:
	@docker compose -f $(DL_DCF) logs -f $(DL_CN)

sh:
	@docker compose -f $(DL_DCF) exec -it $(DL_CN) bash

new:
	@git restore .
	@git pull

run: env
	@echo -e "\033[31mEnter command to run inside container: \033[0m"; \
	read -r cmd; \
	docker compose -f $(DL_DCF) exec $(DL_CN) bash -c "$$cmd"

play:
	@docker run -it --rm --name ubuntu -v "$$(pwd)":/myapp -w /myapp ubuntu:bams
