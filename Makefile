export PROJECT = 'match'

.PHONY: install
install:
	make up
	docker exec -it $(PROJECT)_app cp .env.example .env
	docker exec -it $(PROJECT)_app composer install
	npm install
	make key
	make migrate
	make seed

.PHONY: up
up: 
	docker-compose up -d

.PHONY: stop
stop: 
	docker-compose stop

.PHONY: key
key: ## Generate application key : ## make key
	docker exec -it $(PROJECT)_app php artisan key:generate

.PHONY: migrate
migrate: ## Test all assertions : ## make migrate
	docker exec -it $(PROJECT)_app php artisan migrate

.PHONY: seed
seed: ## Test all assertions : ## make db:seed
	docker exec -it $(PROJECT)_app php artisan db:seed

.PHONY: test
test: ## Test all assertions : ## make test
	docker exec -it $(PROJECT)_app ./vendor/bin/phpunit

.PHONY: ps
ps: ## Test all assertions : ## make ps
	docker ps