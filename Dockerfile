FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip




WORKDIR /var/www/
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN  mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN mkdir IPAMCraft
WORKDIR /var/www/IPAMCraft
COPY . .
#RUN rm -f .env.local
#RUN rm -f -r ./vendor
#RUN rm -f -r ./var
#RUN composer update  --with-all-dependencies
#RUN composer install
#RUN bin/console doctrine:schema:update --force
#RUN bin/console doctrine:schema:update --force
CMD cd /var/www/IPAMCraft && composer update  --with-all-dependencies  && symfony server:start --port=8002