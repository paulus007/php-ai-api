php: ##
	docker compose exec frankenphp bash

migrations-diff: ##
	docker compose exec frankenphp bash -c "bin/console doctrine:migrations:diff"

migrations-migrate: ##
	docker compose exec frankenphp bash -c "bin/console doctrine:migrations:migrate"
