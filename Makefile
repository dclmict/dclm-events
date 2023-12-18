# https://makefiletutorial.com/

SHELL:=/bin/bash

.ONESHELL:
SRC := $(shell \
  os=$$(hostname); \
  if [ "$$os" = "dclm" ]; then \
    cp ./ops/dclm-prod.env ./src/.env; \
	fi; \
  if [ "$$os" = "dclmict" ]; then \
    cp ./ops/dclm-dev.env ./src/.env; \
	fi; \
  if [[ "$$os" != "dclm" && "$$os" != "dclmict" ]]; then \
		branch=$$(git rev-parse --abbrev-ref HEAD); \
		if [[ $$branch == "bams-dev" ]]; then \
			cp ./ops/bams-dev.env ./src/.env; \
		elif [[ $$branch == "dclm-dev" ]]; then \
			cp ./ops/dclm-dev.env ./src/.env; \
		elif [[ $$branch == "dclm-prod" ]]; then \
			cp ./ops/dclm-prod.env ./src/.env; \
		else \
			cp ./ops/bams-dev.env ./src/.env; \
		fi; \
  fi; \
  chmod +x ./ops/sh/app.sh)

# load env file
include ./src/.env

# load makefiles
include ./ops/mk/init.mk
include ./ops/mk/app.mk
include ./ops/mk/deploy.mk
include ./ops/mk/run.mk
include ./ops/mk/utils.mk

# remove double quotes from variable
DL_STACK := $(subst ",,${DL_STACK})

# include app stack
ifeq ($(DL_STACK),laravel)
	include ./ops/mk/laravel.mk
endif

init: init-app

app: build-app

deploy: deploy-app

run: run-app

utils: ops-utils
