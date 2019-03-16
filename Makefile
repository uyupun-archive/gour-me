install:
	cp .env.example .env
	composer install
	php artisan key:generate
	touch database/database.sqlite
	php artisan migrate --seed
	npm install

build:
	rm -rf dist
	npm run generate