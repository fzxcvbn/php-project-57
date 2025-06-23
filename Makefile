PORT ?= 8080

setup: install-env install-deps build-assets generate-app-key migrate run-fill-db

start:
	 php artisan serve --host 0.0.0.0 --port=$(PORT)

test:
	php artisan test

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app tests