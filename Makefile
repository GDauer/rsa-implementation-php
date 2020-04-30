.PHONY: install run

install:
	php composer.phar install; \
	php composer.phar dump-autoload -o;

run:
	php app/index.php
