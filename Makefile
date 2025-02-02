start:
	php artisan serve --host 0.0.0.0

start-frontend:
	npm run dev

setup: env-prepare install key prepare-db
	npm run build

env-prepare:
	cp -n .env.example .env

install:
	composer install
	npm ci

key:
	php artisan key:gen --ansi

prepare-db:
	php artisan migrate:fresh --seed
