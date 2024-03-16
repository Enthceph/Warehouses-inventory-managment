FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

WORKDIR /var/www

CMD ["php-fpm"]
