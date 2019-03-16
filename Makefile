install:
	cp .env.example .env
	php artisan key:generate
	composer install
	php artisan serve

