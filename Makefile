PHPUNIT=./vendor/bin/phpunit

test:
	@rm -rf report
	$(PHPUNIT) --coverage-html ./report
