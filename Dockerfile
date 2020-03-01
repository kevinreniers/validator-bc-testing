FROM php:7.4-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk add --update-cache \
            wget \
            bash \
 && rm -rf /var/cache/apk/* \
 && wget -O /usr/bin/phpunit https://phar.phpunit.de/phpunit-9.phar