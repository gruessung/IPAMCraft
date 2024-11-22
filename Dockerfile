# Dockerfile
FROM php:8.3-fpm

# Installiere System-Tools und PHP-Erweiterungen
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install \
    intl \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    zip \
    && pecl install apcu && docker-php-ext-enable apcu

# Installiere Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Setze den Arbeitsordner
WORKDIR /var/www/symfony

# Kopiere Projektdateien
COPY . .

# Kopiere das Entrypoint-Skript
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Installiere Abhängigkeiten (für den Build)
RUN composer install --optimize-autoloader
RUN composer update

# Exponiere Port 9000
EXPOSE 9000

# Setze das Entrypoint-Skript
ENTRYPOINT ["docker-entrypoint.sh"]

# Fallback zum Starten von PHP-FPM
CMD ["php-fpm"]
