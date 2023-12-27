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
		if [[ $$branch == "bams" ]]; then \
			cp ./ops/bams.env ./src/.env; \
		elif [[ $$branch == "release/dev" ]]; then \
			cp ./ops/dclm-dev.env ./src/.env; \
		elif [[ $$branch == "release/prod" ]]; then \
			cp ./ops/dclm-prod.env ./src/.env; \
		else \
			cp ./ops/bams.env ./src/.env; \
		fi; \
  fi; \
  chmod +x ./ops/sh/app.sh)

# load env file
include ./src/.env

# load makefiles
include ./ops/mk/0-init.mk
include ./ops/mk/1-app.mk
include ./ops/mk/2-push.mk
include ./ops/mk/3-run.mk
include ./ops/mk/4-utils.mk

# remove double quotes from variable
DL_STACK := $(subst ",,${DL_STACK})

# include app stack
ifeq ($(DL_STACK),laravel)
	include ./ops/mk/laravel.mk
endif

init: init-app

app: build-app

push: deploy-app

run: run-app

utils: app-utils
