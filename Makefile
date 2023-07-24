lint:
	vendor/bin/phpstan analyse -c phpstan.neon
	vendor/bin/php-cs-fixer fix

test: lint
