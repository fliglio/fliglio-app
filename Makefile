deps:
	composer up

test:
	php ./vendor/bin/phpunit -c phpunit.xml


.PHONY: test
