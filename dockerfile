# Usa la imagen oficial de PHP
FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mbstring zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

RUN composer clear-cache

RUN composer install --no-interaction --optimize-autoloader -vvv

WORKDIR /var/www/html/public

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html/public"]
