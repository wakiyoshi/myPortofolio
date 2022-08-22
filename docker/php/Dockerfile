FROM php:8.0-fpm

RUN curl https://deb.nodesource.com/setup_12.x | bash
RUN curl https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install -y \
    libpq-dev libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev libicu-dev libxml2-dev libzip-dev libldap2-dev unzip nodejs yarn git \
    && pecl install mcrypt \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install bcmath intl pdo_mysql gd simplexml xml zip ldap

RUN set -eux \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/
COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
COPY ./myPorto /var/www/myPorto

WORKDIR /var/www/myPorto

RUN composer install

RUN chown -R www-data:www-data /var/www/myPorto
RUN chmod -R 777 /var/www/myPorto/storage

EXPOSE 9000