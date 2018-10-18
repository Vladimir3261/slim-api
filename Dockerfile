FROM php:7.2.8-fpm-alpine

RUN apk update && apk add build-base && apk add git
RUN apk add --no-cache libpng libpng-dev && docker-php-ext-install gd && apk del libpng-dev && docker-php-ext-install pdo pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Copy files from current dirctory to container /app directory
COPY . /app
WORKDIR /app

RUN composer install --prefer-source --no-interaction

ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"
