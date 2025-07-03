# ─── 1. Base image with PHP 8.2 & FPM ─────────────────────────────────────────
FROM php:8.2-fpm

# ─── 2. System deps & Postgres driver ────────────────────────────────────────
RUN apt-get update \
 && apt-get install -y \
      libpq-dev zip unzip git curl \
      # for node & npm (you can pin a version or use the distro one)
      nodejs npm \
 && docker-php-ext-install pdo_pgsql \
 && rm -rf /var/lib/apt/lists/*

# ─── 3. Install Composer ──────────────────────────────────────────────────────
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ─── 4. Set workdir ──────────────────────────────────────────────────────────
WORKDIR /var/www/html

# ─── 5. Copy & install PHP deps ──────────────────────────────────────────────
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# ─── 6. Copy & build front-end ───────────────────────────────────────────────
COPY package.json package-lock.json vite.config.js postcss.config.cjs tailwind.config.cjs ./
COPY resources/js resources/css resources/views resources ─adjust paths as needed─
RUN npm ci && npm run build

# ─── 7. Copy the rest of your app ────────────────────────────────────────────
COPY . .

# ─── 8. Expose the port Render will assign ──────────────────────────────────
EXPOSE 10000

# ─── 9. Entrypoint: migrate then serve ───────────────────────────────────────
# We don’t copy or generate a .env here; Render injects APP_KEY, DATABASE_URL, etc.
CMD ["sh","-c","php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
