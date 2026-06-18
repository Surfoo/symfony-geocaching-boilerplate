FROM phpdockerio/php:8.5-fpm
WORKDIR "/application"

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        php8.5-bcmath \
        php8.5-mysql \
        php8.5-intl \
        php8.5-xdebug; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
