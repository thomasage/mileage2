EXEC_DOCKER_COMPOSE = docker-compose
EXEC_SYMFONY = symfony

.PHONY = cs deptrac help install phpstan start stop test

.DEFAULT_GOAL := help

##

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

install: composer.lock yarn.lock ## Install vendors
	@$(EXEC_SYMFONY) composer install

##

start: ## Start dev environement
	@$(EXEC_DOCKER_COMPOSE) up -d \
	&& $(EXEC_SYMFONY) run -d yarn watch \
	&& $(EXEC_SYMFONY) serve -d

stop: ## Stop dev environement
	@$(EXEC_SYMFONY) server:stop \
	&& $(EXEC_DOCKER_COMPOSE) stop

##

cs: ## Fix code style
	@$(EXEC_SYMFONY) run vendor/bin/php-cs-fixer fix

deptrac: ## Analyse dependencies
	@$(EXEC_SYMFONY) run vendor/bin/deptrac --formatter=graphviz

phpstan: ## Static analysis
	@$(EXEC_SYMFONY) run vendor/bin/phpstan analyse

test: ## Run tests suite
	@$(EXEC_SYMFONY) run vendor/bin/phpunit

##
