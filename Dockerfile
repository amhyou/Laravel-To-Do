# ---- Builder Stage ----
FROM composer:2 as builder
WORKDIR /app
RUN apk add --no-cache nodejs npm
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --no-dev --prefer-dist --optimize-autoloader
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# ---- Final Stage ----
FROM php:8.2-fpm-alpine
WORKDIR /var/www/html

# Install extensions
RUN apk add --no-cache nginx \
    && apk add --no-cache --virtual .build-deps sqlite-dev \
    && docker-php-ext-install pdo pdo_sqlite \
    && apk del .build-deps

# Copy application and config
COPY --from=builder /app .
COPY docker/nginx.conf /etc/nginx/nginx.conf

# --- MODIFIED PERMISSIONS ---
# We only need to set permissions for storage now.
RUN chown -R root:root /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000