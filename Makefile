phpstan:
	vendor/bin/phpstan analyse -l 8 src --xdebug

csfixer-dry:
	 vendor/bin/php-cs-fixer fix src --dry-run

csfixer:
	 vendor/bin/php-cs-fixer fix src