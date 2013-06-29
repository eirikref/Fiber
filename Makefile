test:
	@rm -rf report
	phpunit --coverage-html ./report
