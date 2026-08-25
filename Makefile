up: ##
	docker compose up -d

up-rebuild: ##
	docker compose up --build -d

down: ##
	docker compose down

php: ##
	docker compose exec frankenphp bash

migrations-diff: ##
	docker compose exec frankenphp bash -c "bin/console doctrine:migrations:diff"

migrations-migrate: ##
	docker compose exec frankenphp bash -c "bin/console doctrine:migrations:migrate"
