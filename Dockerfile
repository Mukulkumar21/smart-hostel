FROM php:8.2-cli

# Basic system deps (SAFE)
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_sqlite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Composer install (NO artisan scripts)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# SQLite DB file
RUN mkdir -p database && touch database/database.sqlite

EXPOSE 10000

# Runtime only
CMD php artisan migrate --force \
 && php artisan storage:link \
 && php -S 0.0.0.0:10000 -t public
