FROM php:8.2-cli-alpine

# System deps
RUN apk add --no-cache \
    git \
    unzip \
    sqlite \
    sqlite-dev

# Enable PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Composer install (NO scripts)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# SQLite DB
RUN mkdir -p database && touch database/database.sqlite

EXPOSE 10000

CMD php artisan migrate --force \
 && php artisan storage:link \
 && php -S 0.0.0.0:10000 -t public
