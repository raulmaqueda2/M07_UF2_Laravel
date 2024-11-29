FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

USER www-data

RUN composer install --no-interaction --optimize-autoloader

WORKDIR /var/www/html/public

RUN echo 'DocumentRoot /var/www/html/public' > /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
