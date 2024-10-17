DOCKER_DIR=docker

up:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml up -d && \
    docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php composer install

init-migration:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php php bin/console make:migration

migration:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php php bin/console doctrine:migrations:migrate

fixtures:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php php bin/console doctrine:fixtures:load --no-interaction

fetch-tasks:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php php bin/console fetch-task

test:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml exec php ./vendor/bin/phpunit --testdox

down:
	docker-compose -f $(DOCKER_DIR)/docker-compose.yaml down