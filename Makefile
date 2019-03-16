install:
	cp .env.example .env
	composer install
	php artisan key:generate
	touch database/database.sqlite
	php artisan migrate --seed
	npm install

deploy:
	rm -rf docs
	npm run generate
	mv dist docs
