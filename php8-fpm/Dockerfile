FROM php:8.1-fpm

WORKDIR /var/www

#COPY php-fpm.conf /usr/local/etc/php-fpm.conf
RUN docker-php-ext-install pdo pdo_mysql

cmd ["php-fpm"]
