FROM php:7.2-fpm
COPY ./conf.d /usr/local/etc/php/conf.d
RUN docker-php-ext-install pdo pdo_mysql

