FROM phpdockerio/php:8.3-fpm
WORKDIR "/application"

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        php8.3-bcmath \ 
        php8.3-mysql \ 
        php8.3-intl \ 
        php8.3-xdebug; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
