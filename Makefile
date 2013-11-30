PWD = $(shell pwd)

docs: vendor/phpdocumentor/phpdocumentor/bin/phpdoc.php docs/logs
	php vendor/phpdocumentor/phpdocumentor/bin/phpdoc.php --config phpdoc.xml

docs/logs:
	mkdir -p docs/logs

test:	vendor/phpunit/phpunit
	phpunit

vendor/phpunit/phpunit:
	composer update

vendor/phpdocumentor/phpdocumentor/bin/phpdoc.php:
	composer update

.PHONY: docs
