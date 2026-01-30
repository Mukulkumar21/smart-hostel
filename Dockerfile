FROM php:8.2-cli

# System dependencies (FIXED)
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_sqlite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# IMPORTANT: no artisan scripts during build
RUN composer install --no-dev --optimize-autoloader --no-scripts

# SQLite database file
RUN mkdir -p database && touch database/database.sqlite

EXPOSE 10000

# Runtime only
CMD php artisan migrate --force \
 && php artisan storage:link \
 && php -S 0.0.0.0:10000 -t public
