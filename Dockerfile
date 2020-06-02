# the different stages of this Dockerfile are meant to be built into separate images
# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target
# https://docs.docker.com/compose/environment-variables/

# https://docs.docker.com/engine/reference/builder/#understand-how-arg-and-from-interact

FROM php:7.4-fpm-alpine as php

ENV SYMFONY_BINARY_URL=https://github.com/symfony/cli/releases/download/v4.14.4/symfony_linux_amd64.gz
ENV SYMFONY_BINARY_SHA256=172f63b70881abe5fdfb4968125cb1294d09d477a675c10670b937b23d8a6c19

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_MEMORY_LIMIT -1
COPY --from=composer /usr/bin/composer /usr/bin/composer

# required packages and PHP extensionns
RUN set -eux ; \
    apk add  --no-cache git  \
        zip \
        unzip \
        curl \
        libpq \
        icu-libs \
        acl \
        fcgi  \
        bash \
        libcurl \
        gettext \
        gnu-libiconv  \
        gnupg  \
        ncurses  \
        jq ; \
    apk add --no-cache --virtual .fetch-deps \
        icu-dev \
        postgresql-dev \
        autoconf \
        musl-dev \
        gcc \
        g++ \
        make \
        pkgconf \
        file ; \
    docker-php-ext-install -j$(nproc) \
    pdo  \
    pdo_pgsql \
    intl \
    pcntl ; \
    pecl install xdebug; \
    docker-php-ext-enable opcache ; \
    docker-php-ext-enable xdebug ; \
    echo "xdebug.remote_enable = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_connect_back = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini ; \
    curl -s -L \
        $SYMFONY_BINARY_URL \
        -o symfony_linux_amd64.gz ; \
   gunzip symfony_linux_amd64.gz ; \
   sha256sum symfony_linux_amd64  | grep $SYMFONY_BINARY_SHA256 ; \
       chmod +x  symfony_linux_amd64 ; \
   mv symfony_linux_amd64 /usr/bin/symfony ;

ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

COPY ./docker/php/docker-entrypoint.sh  /usr/local/bin/docker-entrypoint
COPY ./docker/php/php-fpm.d/zzz-01-healthcheck.conf /usr/local/etc/php-fpm.d/zzz-01-healthcheck.conf
COPY ./docker/php/php-fpm-healthcheck.sh /usr/local/bin/php-fpm-healthcheck
COPY ./docker/php/php-ini-directives.ini.template /usr/local/etc/php/php-ini-directives.ini.template

# install Symfony Flex globally to speed up download of Composer packages (parallelized prefetching) \
RUN set -eux ; \
    chmod +x /usr/local/bin/docker-entrypoint; \
    chmod 755 /usr/local/bin/php-fpm-healthcheck ; \
    composer --ansi --version --no-interaction; \
    composer global require "symfony/flex" --prefer-dist --no-progress --no-suggest --classmap-authoritative; \
	composer clear-cache;

HEALTHCHECK --start-period=5m  CMD php-fpm-healthcheck
ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

WORKDIR /srv/app

COPY  backend/composer.json \
    backend/composer.lock \
    backend/symfony.lock \
    backend/.env \
    backend/.env.test \
    backend/phpunit.xml.dist \
    backend/phpstan.neon.dist \
    backend/phpcs.xml.dist \
    backend/behat.yml.dist \
      ./

RUN set -eux; \
	composer install --prefer-dist --no-autoloader --no-scripts --no-progress --no-suggest; \
	mkdir -p config/jwt var/cache var/log import public/multimedia; \
	composer clear-cache

COPY backend/bin bin/
COPY backend/config config/
COPY backend/public public/
COPY backend/src src/
COPY backend/templates templates/
#COPY backend/translations translations/

#clean up
RUN set -eux; \
    chmod +x bin/console; \
	composer dump-autoload --optimize; \
	composer dump-env prod; \
    composer run-script post-install-cmd; \
	bin/console cache:clear --env=prod --no-debug ; \
	bin/console cache:clear --env=dev

FROM php as php_production
	# do not use .env  in production
RUN set -eux; \
    pecl uninstall xdebug ; \
    rm -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    # remove unnecessary dev packages
    apk del --no-network .fetch-deps ; \
    php --version ; \
	rm -f .env \
     .env.test \
     *.dist \
     *.md \
     tests \
     features

FROM nginx:1.18-alpine AS nginx

RUN  set -eux; \
    apk add  --no-cache \
    curl \
    bash ; \
    rm -rf /tmp/*

COPY ./docker/nginx/conf.d/http-directives.conf.template /etc/nginx/conf.d/http-directives.conf.template
COPY ./docker/nginx/conf.d/symfony-development.conf.template /etc/nginx/conf.d/symfony-development.conf.template
COPY ./docker/nginx/conf.d/symfony-production.conf.template /etc/nginx/conf.d/symfony-production.conf.template
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
COPY --from=php /srv/app/public /srv/app/public

RUN chmod +x /usr/local/bin/docker-entrypoint

HEALTHCHECK --start-period=5m CMD curl --fail http://localhost || exit 1

ENV NGINX_HTTP_DIRECTIVES="client_max_body_size 250m;"

ENTRYPOINT ["docker-entrypoint"]
CMD ["nginx", "-g", "daemon off;"]


FROM postgres:12-alpine as postgres

COPY ./docker/postgres/docker-entrypoint-initdb.d /docker-entrypoint-initdb.d
COPY ./docker/postgres/postgres-healthcheck.sh  /usr/local/bin/postgres-healthcheck.sh
COPY ./docker/postgres/common-functions.sh /usr/local/bin/common-functions.sh

RUN chmod +x /usr/local/bin/postgres-healthcheck.sh

HEALTHCHECK --start-period=5m CMD bash -c /usr/local/bin/postgres-healthcheck.sh
