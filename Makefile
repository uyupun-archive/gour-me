install:
	cp .env.example .env
	php artisan key:generate
	composer install
	touch database/database.sqlite
	php artisan migrate --seed
	npm install
