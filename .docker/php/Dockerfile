# Base image, we cvan install globally required PHP extensions here
FROM php:8.4-fpm-alpine AS base
WORKDIR /app
ADD --chmod=0755 \
    https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions \
    /usr/local/bin/
RUN install-php-extensions intl pdo_mysql

# Target to copy composer to the image and configure composer with ENV variables
FROM base AS composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HOME=/tmp/.composer
COPY --from=composer/composer:2-bin /composer /usr/bin/composer

# Dev image target, here we can install development only extensions and add config files
FROM composer AS dev
RUN install-php-extensions xdebug

# Builder target for the prod image, this target will builde the project (install dependencies only)
FROM composer AS builder
COPY --link ./composer.* ./ ./
ENV COMPOSER_FUND=0
RUN --mount=type=ssh \
    set -eux; \
    composer install --prefer-dist --no-interaction --no-dev --no-scripts --no-progress

# Final prod target, uses the installed dependncies from builder target and run som composer commands
# TODO: Remove composer and extension installer when finished to minimize image size
FROM builder AS prod
COPY . .
COPY --from=builder /app/vendor ./vendor
RUN set -eux; \
	composer dump-autoload --classmap-authoritative --no-dev; \
	composer dump-env prod; \
	composer run-script --no-dev post-install-cmd; \
	chmod +x bin/console; sync;
