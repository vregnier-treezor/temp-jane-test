DOCKER_COMPOSE?=docker-compose
DOCKER?=docker
COMPOSER=$(DOCKER_COMPOSE) exec -T php composer
CONTAINERS=$(DOCKER) ps -a -q

.DEFAULT_GOAL := help

help:
	@grep -E '(^[0-9a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

##
## Manage docker containers
##---------------------------------------------------------------------------


start: clear-containers up ## Remove & start containers

up: network ## Run containers
	$(DOCKER_COMPOSE) up -d --remove-orphans

network: ## Create Docker network
	$(DOCKER) network create jane-open-api-test | true

clear-containers: ## Remove containers
	$(DOCKER) stop `$(CONTAINERS)`
	$(DOCKER) rm `$(CONTAINERS)` --force
	$(DOCKER_COMPOSE) rm `$(CONTAINERS)` --force


##
## Project setup
##---------------------------------------------------------------------------

composer-install: up ## Install php dependencies
	$(COMPOSER) install

##
## Project tools
##---------------------------------------------------------------------------

php-console: up ## Start php console
	$(DOCKER_COMPOSE) run --rm php sh

docker-login:
	aws ecr get-login-password --profile trzDev | docker login --username AWS --password-stdin 786403377595.dkr.ecr.eu-west-3.amazonaws.com