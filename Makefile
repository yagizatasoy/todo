DOCKER_DIR=docker

up:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml up -d

setup-migration:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php php bin/console make:migration

migrate:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php php bin/console doctrine:migrations:migrate

fixtures:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php php bin/console doctrine:fixtures:load --no-interaction

fetch-tasks:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php php bin/console fetch-task

test:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php ./vendor/bin/phpunit

down:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml down