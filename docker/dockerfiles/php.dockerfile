FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

RUN groupadd -g 1000 laravel && useradd -u 1000 -g laravel -m laravel

RUN chown -R laravel:laravel /var/www/html

USER laravel

WORKDIR /var/www

CMD ["php-fpm"]
