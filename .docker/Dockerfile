# This image is running behat and will look for hautelook namespace in /src/src.
FROM php:5.6-fpm

ENV COMPOSER_VERSION 1.2.0
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN \
	# Install Composer
	curl -sSL https://github.com/composer/composer/releases/download/$COMPOSER_VERSION/composer.phar -o /usr/local/bin/composer && \
	chmod +x /usr/local/bin/composer

RUN apt-get update && apt-get install -y zlib1g-dev \
    && docker-php-ext-install zip
RUN apt-get install -y git-core

COPY composer.json /opt/behat/composer.json
RUN \
    cd /opt/behat/ && composer install

WORKDIR /src

CMD ["/opt/behat/bin/behat"]