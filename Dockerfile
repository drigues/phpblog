# 1. Use official PHP-FPM image
FROM php:8.1-fpm

# 2. Install system deps & PostgreSQL driver
RUN apt-get update \
 && apt-get install -y \
      libpq-dev \
      zip unzip git curl \
 && docker-php-ext-install pdo_pgsql

# 3. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Set working directory
WORKDIR /var/www/html

# 5. Copy app & install PHP deps
COPY . /var/www/html
RUN composer install --no-dev --optimize-autoloader

# 6. Copy example env & generate key
RUN cp .env.example .env \
 && php artisan key:generate

# 7. Expose the port Render will use
EXPOSE 10000

# 8. Start the app with artisan (uses $PORT)
CMD ["sh","-c","php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
