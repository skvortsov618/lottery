FROM php:8.1-fpm
WORKDIR /var/www/project
RUN apt-get update && apt-get install -y zip libzip-dev && docker-php-ext-configure zip && docker-php-ext-install mysqli pdo_mysql zip
RUN curl -sS https://getcomposer.org/installer | php
COPY composer.json /var/www/project/
COPY composer.lock /var/www/project/
COPY php.ini /usr/local/etc/php/php.ini
RUN php composer.phar install
CMD ["php-fpm"]
EXPOSE 9000