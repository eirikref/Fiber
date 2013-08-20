PHPUNIT=./vendor/bin/phpunit
PHPCS=./vendor/bin/phpcs

all: sniff test

test:
	@rm -rf report
	$(PHPUNIT) --coverage-html ./report

sniff:
	$(PHPCS) --standard=PSR2 ./src ./tests
